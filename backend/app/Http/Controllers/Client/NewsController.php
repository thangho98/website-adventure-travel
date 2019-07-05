<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use DB;

class NewsController extends Controller
{
    //
    public function Index()
    {
        $data['news'] = $this->getNews();
        $data['tours_hot'] = $this->getToursHot();
        return view('client.news', $data);
    }

    public function IndexNew($id)
    {
        $data['new'] = $this->getNew($id);
        $data['tours_hot'] = $this->getToursHot();
        return view('client.new', $data);
    }

    public function getNews(){
        $data = DB::table('news')
        ->join('users', 'news_user_admin', 'id')
        ->orderByDesc('news_id')
        ->get();

        return $data;
    }

    public function getNew($id){
        $data = DB::table('news')
        ->join('users', 'news_user_admin', 'id')
        ->where('news_id', $id)
        ->get()
        ->first()   ;

        return $data;
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
