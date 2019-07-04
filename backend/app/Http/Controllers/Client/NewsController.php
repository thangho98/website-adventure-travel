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
       
        return view('client.news');
    }

    public function getNews(){
    }
    
}
