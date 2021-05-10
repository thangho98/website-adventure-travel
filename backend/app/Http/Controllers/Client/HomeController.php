<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use DB;

class HomeController extends Controller
{
    //
    public function Index()
    {
        $data['categories'] = $this->getCategory();
        $data['tours_hot'] = $this->getToursHot()->take(4);
        $data['tours_latest'] = $this->getToursLatest()->take(4);
        $data['tours_last_hour'] = $this->getToursLastHour();
        return view('client.home', $data);
    }

    public function IndexToursLastHour()
    {
        $data['tours'] = $this->getToursLastHour();
        $data['tit'] = 'Tours giờ chót';
        $data['title'] = 'DANH SÁCH TOURS GIỜ CHÓT';
        return view('client.list_tours', $data);
    }

    public function IndexToursHot()
    {
        $data['tours'] = $this->getToursHot();
        $data['tit'] = 'Tours đang hot';
        $data['title'] = 'DANH SÁCH TOURS ĐANG HOT';
        return view('client.list_tours', $data);
    }

    public function IndexToursLatest()
    {
        $data['tours'] = $this->getToursLatest();
        $data['tit'] = 'Tours mới nhất';
        $data['title'] = 'DANH SÁCH TOURS MỚI NHẤT';
        return view('client.list_tours', $data);
    }

    public function IndexActivity($id)
    {
        $tit = $data = DB::table('categories')
            ->where('cate_id', $id)
            ->get();

        $data['tours'] = $this->getToursActivity($id);
        $data['tit'] = 'Danh sách tours ' . $tit[0]->cate_name;
        $data['title'] = 'DANH SÁCH TOURS ' . strtoupper($tit[0]->cate_name);
        return view('client.list_tours', $data);
    }

    public function getToursActivity($id)
    {
        $data = DB::table('tourist_routes')
            ->leftJoin('reviews', 'tr_id', 'revi_tourist_route')
            ->join('tours', 'tr_id', 'tour_tourist_route')
            ->join('categories', 'tr_category', 'cate_id')
            ->join('locations', 'tr_location', 'loca_id')
            ->leftJoin('promotions', 'tour_promotion', 'prom_id')
            ->where('tour_status', 0)
            ->where('cate_id', $id)
            ->select(DB::raw('tr_id, tr_name, tour_code, tr_poster, cate_name, tour_time_start, loca_name, tr_time, tr_max_slot, tour_slot_book,tr_original_price,tour_price, tour_promotion, avg(revi_star) as avg , count(revi_id) as count'))
            ->groupBy('tr_id', 'tr_name', 'tour_code', 'tr_poster', 'cate_name', 'tour_time_start', 'loca_name', 'tr_time', 'tr_max_slot', 'tour_slot_book', 'tr_original_price', 'tour_price', 'tour_promotion')
            ->orderBy('tour_time_start')
            ->get();

        return $data;
    }

    public function getCategory()
    {
        $data = DB::table('categories')
            ->orderByDesc('cate_id')
            ->take(4)
            ->get();

        return $data;
    }

    public function getToursHot()
    {
        $data = DB::table('tourist_routes')
            ->leftJoin('reviews', 'tr_id', 'revi_tourist_route')
            ->join('tours', 'tr_id', 'tour_tourist_route')
            ->join('categories', 'tr_category', 'cate_id')
            ->join('locations', 'tr_location', 'loca_id')
            ->where('tour_status', 0)
            ->select(DB::raw('tr_id, tr_name, tour_code, tr_poster, cate_name, tour_time_start, loca_name, tr_time, tr_max_slot, tour_slot_book,tr_original_price,tour_price, tour_promotion, avg(revi_star) as avg , count(revi_id) as count'))
            ->groupBy('tr_id', 'tr_name', 'tour_code', 'tr_poster', 'cate_name', 'tour_time_start', 'loca_name', 'tr_time', 'tr_max_slot', 'tour_slot_book', 'tr_original_price', 'tour_price', 'tour_promotion')
            ->orderBy('tour_slot_book')
            ->orderBy('tour_time_start')
            ->get();

        return $data;
    }

    public function getToursLatest()
    {
        $data = DB::table('tourist_routes')
            ->leftJoin('reviews', 'tr_id', 'revi_tourist_route')
            ->join('tours', 'tr_id', 'tour_tourist_route')
            ->join('categories', 'tr_category', 'cate_id')
            ->join('locations', 'tr_location', 'loca_id')
            ->where('tour_status', 0)
            ->select(DB::raw('tr_id, tr_name, tour_code, tr_poster, cate_name, tour_time_start, loca_name, tr_time, tr_max_slot, tour_slot_book,tr_original_price,tour_price, tour_promotion, avg(revi_star) as avg , count(revi_id) as count'))
            ->groupBy('tr_id', 'tr_name', 'tour_code', 'tr_poster', 'cate_name', 'tour_time_start', 'loca_name', 'tr_time', 'tr_max_slot', 'tour_slot_book', 'tr_original_price', 'tour_price', 'tour_promotion')
            ->orderByDesc('tr_id')
            ->orderBy('tour_time_start')
            ->get();

        return $data;
    }

    public function getToursLastHour()
    {
        $data = DB::table('tourist_routes')
            ->leftJoin('reviews', 'tr_id', 'revi_tourist_route')
            ->join('tours', 'tr_id', 'tour_tourist_route')
            ->join('categories', 'tr_category', 'cate_id')
            ->join('locations', 'tr_location', 'loca_id')
            ->where('tour_status', 0)
            ->select(DB::raw('tr_id, tr_name, tour_code, tr_poster, cate_name, tour_time_start, loca_name, tr_time, tr_max_slot, tour_slot_book,tr_original_price,tour_price, tour_promotion, avg(revi_star) as avg , count(revi_id) as count'))
            ->groupBy('tr_id', 'tr_name', 'tour_code', 'tr_poster', 'cate_name', 'tour_time_start', 'loca_name', 'tr_time', 'tr_max_slot', 'tour_slot_book', 'tr_original_price', 'tour_price', 'tour_promotion')
            ->orderBy('tour_time_start')
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
    }
}