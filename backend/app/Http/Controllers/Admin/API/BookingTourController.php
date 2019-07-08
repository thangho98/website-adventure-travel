<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BookingTour;
use App\Models\Tour;
use App\Models\TouristRoute;
use App\Models\Promotion;
use DB;
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
}