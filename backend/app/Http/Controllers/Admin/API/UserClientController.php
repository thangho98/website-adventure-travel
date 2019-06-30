<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserClient;
use App\Models\BookingTour;
use DB;

class UserClientController extends Controller
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
            return UserClient::latest()->paginate(5);
        }
        else
            return ["message"=>"fail"];
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
        $data['user_client'] = UserClient::find($id);
        
        $data['booking_tours'] = DB::table('booking_tours')
        ->where('bt_user_client',$id)
        ->join('tours','booking_tours.bt_tour','tours.tour_id')
        ->join('tourist_routes','tourist_routes.tr_id','tours.tour_tourist_route')
        ->orderBy('bt_id','desc')
        ->get();

        $data['reviews'] = DB::table('reviews')
        ->where('revi_user_client',$id)
        ->join('tourist_routes','reviews.revi_tourist_route','tourist_routes.tr_id')
        ->select(DB::raw('revi_id, revi_star, revi_content, revi_time, revi_tourist_route, tr_name, revi_user_client'))
        ->orderBy('tr_id','desc')
        ->get();

        return response()->json($data, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}