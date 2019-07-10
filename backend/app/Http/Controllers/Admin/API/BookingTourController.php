<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserClient;
use App\Models\BookingTour;
use App\Models\Tour;
use App\Models\TouristRoute;
use App\Models\Promotion;
use DB;
use Mail;
class BookingTourController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            
            $list = DB::table('booking_tours')
                    ->join('user_clients','user_clients.user_id','booking_tours.bt_user_client')
                    ->join('tours','tours.tour_id','booking_tours.bt_tour')
                    ->join('tourist_routes','tourist_routes.tr_id','tours.tour_tourist_route')
                    ->orderBy('bt_id','desc')
                    ->get();

            return $list;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');
        $booking = BookingTour::find($id);
        $booking->bt_status = 1;
        $booking->save();

        $tour_detail = $this->getDetail($booking->bt_tour);
        $name = " Tour du lịch ".$tour_detail->tr_name.", Mã Tour:  ".$tour_detail->tour_code.
        ", Ngày khởi hành: ".date("d/m/Y", strtotime($tour_detail->tour_time_start));

        $data['info'] = $booking;
        $data['profile'] = $this->getProfile($booking->bt_user_client);
        $email =  $data['profile']->email;
        $data['tour_detail'] = $tour_detail;
        
        Mail::send('client.email_paid', $data, function ($message) use($email, $name) {
            $message->from('thanglong2098@gmail.com', 'Y2T Tour');

            $message->to($email, $email);

            $message->cc('16521095@gm.uit.edu.vn', 'Y2T Tour');

            $message->subject('Vé tham dự '.$name);
        });

        return ['message' => 'BookingTour payed'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $booking = BookingTour::find($id);
        $booking->bt_status = 2;
        $booking->save();
        return ['message' => 'BookingTour cancelled'];
    }

    public function getDetail($id)
    {
        $data = DB::table('tours')
            ->where('tour_id', $id)
            ->join('tourist_routes',  'tour_tourist_route', 'tr_id')
            ->join('categories', 'tr_category', 'cate_id')
            ->join('locations', 'tr_location', 'loca_id')
            ->leftJoin('promotions', 'tour_promotion', 'prom_id')
            ->first();
        return $data;
    }

    public function getProfile($id)
    {
        $data = UserClient::find($id);
        return $data;
    }
}