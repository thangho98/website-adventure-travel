<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\UserClient;
use App\Models\BookingTour;
use App\Models\Tour;


use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use Session;
use Illuminate\Support\Facades\URL;
use Redirect;
use Mail;
class BookingController extends Controller
{
    
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    
    public function Index($code)
    {
        $data['user'] = $this->getProfile();
        $data['tour_detail'] = $this->getDetail($code);
        $data['review_score'] = $this->getReviewScore($code);
        $data['tours_hot'] = $this->getToursHot();

        return view('client.booking', $data);
    }

    public function getProfile()
    {
        $data = Auth::guard('client')->user();
        return $data;
    }

    public function getDetail($code)
    {
        $data = DB::table('tours')
            ->where('tour_code', $code)
            ->join('tourist_routes',  'tour_tourist_route', 'tr_id')
            ->join('categories', 'tr_category', 'cate_id')
            ->join('locations', 'tr_location', 'loca_id')
            ->leftJoin('promotions', 'tour_promotion', 'prom_id')
            ->first();
        return $data;
    }

    public function getReviewScore($code)
    {
        $data['score'] = DB::table('tours')
            ->where('tour_code', $code)
            ->join('reviews', 'tour_tourist_route', 'revi_tourist_route')
            ->select(DB::raw('avg(revi_star) as avg'))
            ->get()
            ->first()
            ->avg;

        $data['count_comments'] = DB::table('tours')
            ->where('tour_code', $code)
            ->join('reviews', 'tour_tourist_route', 'revi_tourist_route')
            ->select(DB::raw('count(revi_id) as count'))
            ->get()
            ->first()
            ->count;

        return $data;
    }

    public function BookTour(Request $request, $code)
    {
        //dd($request['book']);
        if($request['book'] == "paypal"){
           //dd($request);
            $json = file_get_contents('http://www.apilayer.net/api/live?access_key=6a03554aed894187d3efc69c243dd703');
            $obj = json_decode($json, true);

            $USDVND = $obj["quotes"]["USDVND"];

            //dd($USDVND);

            $priceOrigin = $this->getDetail($code)->tour_price;
            $bt_total_price = ($request->num_child * $priceOrigin / 2 + $request->num_adult * $priceOrigin)/$USDVND;

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();
            
            $tour_detail = $this->getDetail($code);
            $name = " Tour du lịch ".$tour_detail->tr_name.", Mã Tour:  ".$code.
            ", Ngày khởi hành: ".date("d/m/Y", strtotime($tour_detail->tour_time_start));

            $item_1->setName($name) /** item name **/
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($bt_total_price); /** unit price **/

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($bt_total_price);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::to('clients/status/'.$code.'?num_child='.$request->num_child.'&num_adult='.$request->num_adult)) /** Specify return URL **/
                ->setCancelUrl(URL::to('clients/status/'.$code.'?num_child='.$request->num_child.'&num_adult='.$request->num_adult));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
            try {

                $payment->create($this->_api_context);

            } catch (\PayPal\Exception\PPConnectionException $ex) {

                if (\Config::get('app.debug')) {

                    \Session::put('error', 'Connection timeout');
                    return Redirect::to('/clients/booking/'.$code);

                } else {

                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return Redirect::to('/clients/booking/'.$code);

                }

            }

            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;

                }

            }

            /** add payment ID to session **/
            Session::put('paypal_payment_id', $payment->getId());

            if (isset($redirect_url)) {

                /** redirect to paypal **/
                return Redirect::away($redirect_url);

            }

            \Session::put('error', 'Unknown error occurred');
            return Redirect::to('/clients/booking/'.$code);
        }
        else{
            $book = new BookingTour;
            $book->bt_num_child = $request->num_child;
            $book->bt_num_adult = $request->num_adult;
            $book->bt_date = Carbon::now()->toDateTimeString();
            $book->bt_status = 0;
            $book->bt_user_client = $this->getProfile()->user_id;
            $book->bt_tour = $this->getDetail($code)->tour_id;
            $priceOrigin = $this->getDetail($code)->tour_price;
            $book->bt_total_price = $request->num_child * $priceOrigin / 2 + $request->num_adult * $priceOrigin;
            $book->save();
            
            $tour = Tour::find($this->getDetail($code)->tour_id);
            $slot = $tour->tour_slot_book + $book->bt_num_child + $book->bt_num_adult;

            DB::table('tours')
            ->where('tour_code', $code)
            ->update(['tour_slot_book' => $slot]);

            $tour_detail = $this->getDetail($code);
            $name = " Tour du lịch ".$tour_detail->tr_name.", Mã Tour:  ".$code.
            ", Ngày khởi hành: ".date("d/m/Y", strtotime($tour_detail->tour_time_start));

            $data['profile'] = $this->getProfile();
            $email =  $data['profile']->email;
            $data['tour_detail'] = $tour_detail;
            $data['info'] = $book;
            
            Mail::send('client.email_book', $data, function ($message) use($email, $name) {
                $message->from('thanglong2098@gmail.com', 'Y2T Tour');
    
                $message->to($email, $email);
    
                $message->cc('16521095@gm.uit.edu.vn', 'Y2T Tour');
    
                $message->subject('Xác nhận đơn hàng cho '.$name);
            });
                
            return redirect(route('personal'));
        }
    }

    public function getToursHot()
    {
        $data = DB::table('tourist_routes')
            ->leftJoin('reviews', 'tr_id', 'revi_tourist_route')
            ->join('tours', 'tr_id', 'tour_tourist_route')
            ->join('categories', 'tr_category', 'cate_id')
            ->join('locations', 'tr_location', 'loca_id')
            ->whereDate('tour_time_start', '>', Carbon::now()->toDateString())
            ->select(DB::raw('tr_id, tr_name, tour_code, tr_poster, cate_name, tour_time_start, loca_name, tr_time, tr_max_slot, tour_slot_book,tr_original_price,tour_price, tour_promotion, avg(revi_star) as avg , count(revi_id) as count'))
            ->groupBy('tr_id', 'tr_name', 'tour_code', 'tr_poster', 'cate_name', 'tour_time_start', 'loca_name', 'tr_time', 'tr_max_slot', 'tour_slot_book', 'tr_original_price', 'tour_price', 'tour_promotion')
            ->orderBy('tour_slot_book')
            ->orderBy('tour_time_start')
            ->get();

        return $data;
    }

    public function getPaymentStatus(Request $request, $code)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error', 'Payment failed');
            return Redirect::to('/clients/booking/'.$code);

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            $book = new BookingTour;
            $book->bt_num_child = $request->num_child;
            $book->bt_num_adult = $request->num_adult;
            $book->bt_date = Carbon::now()->toDateTimeString();
            $book->bt_status = 1;
            $book->bt_user_client = $this->getProfile()->user_id;
            $book->bt_tour = $this->getDetail($code)->tour_id;

            $priceOrigin = $this->getDetail($code)->tour_price;
            $book->bt_total_price = $request->num_child * $priceOrigin / 2 + $request->num_adult * $priceOrigin;

            $book->save();

            $tour = Tour::find($this->getDetail($code)->tour_id);
            $slot = $tour->tour_slot_book + $book->bt_num_child + $book->bt_num_adult;

            DB::table('tours')
            ->where('tour_code', $code)
            ->update(['tour_slot_book' => $slot]);

            $tour_detail = $this->getDetail($code);
            $name = " Tour du lịch ".$tour_detail->tr_name.", Mã Tour:  ".$code.
            ", Ngày khởi hành: ".date("d/m/Y", strtotime($tour_detail->tour_time_start));

            $data['profile'] = $this->getProfile();
            $email =  $data['profile']->email;
            $data['tour_detail'] = $tour_detail;
            $data['info'] = $book;
            
            Mail::send('client.email_paid', $data, function ($message) use($email, $name) {
                $message->from('thanglong2098@gmail.com', 'Y2T Tour');
    
                $message->to($email, $email);
    
                $message->cc('16521095@gm.uit.edu.vn', 'Y2T Tour');
    
                $message->subject('Vé tham dự '.$name);
            });

            return redirect(route('personal'));
        }

        \Session::put('error', 'Payment failed');
        return Redirect::to('/clients/booking/'.$code);

    }
}