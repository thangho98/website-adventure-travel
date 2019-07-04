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

class BookingController extends Controller
{
    //
    public function Index($code)
    {
        $data['user'] = $this->getProfile();
        $data['tour_detail'] = $this->getDetail($code);
        $data['review_score'] = $this->getReviewScore($code);


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
            ->join('promotions', 'tour_promotion', 'prom_id')
            ->get();
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
        $book = new BookingTour;
        $book->bt_num_child = $request->num_child;
        $book->bt_num_adult = $request->num_adult;
        $book->bt_date = Carbon::now()->toDateTimeString();
        $book->bt_status = 0;
        $book->bt_user_client = $this->getProfile()->user_id;
        $book->bt_tour = $this->getDetail($code)->first()->tour_id;

        $priceOrigin = $this->getDetail($code)->first()->tour_price;
        $book->bt_total_price = $request->num_child * $priceOrigin / 2 + $request->num_adult * $priceOrigin;

        $book->save();

        return "Thành công";
    }
}