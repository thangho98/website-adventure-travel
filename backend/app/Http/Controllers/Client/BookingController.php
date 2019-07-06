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

class BookingController extends Controller
{
    //
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

        $tour = Tour::find($this->getDetail($code)->first()->tour_id);
        $slot = $tour->tour_slot_book + $book->bt_num_child + $book->bt_num_adult;

        DB::table('tours')
        ->where('tour_code', $code)
        ->update(['tour_slot_book' => $slot]);

        return redirect(route('personal'));
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
}
