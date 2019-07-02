<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function Index()
    {
        $data['categories'] = $this->getCategory();
        $data['tours_hot'] = $this->getToursHot();
        return view('client.home', $data);
    }

    public function getCategory()
    {
        $data = DB::table('categories')
            ->orderByDesc('cate_id')
            ->take(4)
            ->get();

        return $data;
    }

    public function getToursHot(){
        $data = DB::table('tours')
        ->join('tourist_routes', 'tour_tourist_route', 'tr_id')
        ->join('categories','tr_category','cate_id')
        ->orderBy('tour_time_start')
        ->take(4)
        ->get();

        return $data;
    }
}
