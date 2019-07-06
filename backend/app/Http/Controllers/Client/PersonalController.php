<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\UserClient;

class PersonalController extends Controller
{
    //
    public function Index()
    {
        $data['user'] = $this->getProfile();
        $data['booked'] = $this->getToursBooked(); 
        $data['tours_hot'] = $this->getToursHot();
        
        return view('client.personal', $data);
    }

    public function getProfile(){
        $data = Auth::guard('client')->user();
        return $data;
    }

    public function UpdateProfile(Request $request)
    {
        $user = UserClient::find($this->getProfile()->user_id);

        $user->user_name = $request->name;
        $user->user_birthday = $request->birthday;
        $user->email = $request->email;
        $user->user_phone = $request->phone;
        $user->user_address = $request->address;

        $user->save();

        return back();
    }

    public function getToursBooked()
    {
        $data = DB::table('user_clients')
            ->where('user_id', $this->getProfile()->user_id)
            ->leftJoin('booking_tours','user_id', 'bt_user_client')
            ->leftJoin('tours', 'bt_tour', 'tour_id')
            ->leftJoin('tourist_routes', 'tour_tourist_route', 'tr_id')
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
            ->whereDate('tour_time_start', '>', Carbon::now()->toDateString())
            ->select(DB::raw('tr_id, tr_name, tour_code, tr_poster, cate_name, tour_time_start, loca_name, tr_time, tr_max_slot, tour_slot_book,tr_original_price,tour_price, tour_promotion, avg(revi_star) as avg , count(revi_id) as count'))
            ->groupBy('tr_id', 'tr_name', 'tour_code', 'tr_poster', 'cate_name', 'tour_time_start', 'loca_name', 'tr_time', 'tr_max_slot', 'tour_slot_book', 'tr_original_price', 'tour_price', 'tour_promotion')
            ->orderBy('tour_slot_book')
            ->orderBy('tour_time_start')
            ->get();

        return $data;
    }
  
}
