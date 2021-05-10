<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Revenue;
use DB;

class RevenueController extends Controller
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
            return Revenue::latest()->get();
        }
        else
            return response()->json(["message"=>"fail"], 403);
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
        $revenue = Revenue::find($id);

        $data['list_tour'] = DB::table('tours')
                    ->join('tourist_routes','tours.tour_tourist_route','tourist_routes.tr_id')
                    ->leftJoin('promotions','tours.tour_promotion','promotions.prom_id')
                    ->orderBy('tr_id','desc')
                    ->where('tour_status', 3)
                    ->whereMonth('tour_time_start','=',$revenue->reve_month)
                    ->whereYear('tour_time_start','=',$revenue->reve_year)
                    ->get();

        $data['sum_tour_total_fare'] = collect($data['list_tour'])->sum('tour_total_fare');
        $data['sum_tour_cost'] = collect($data['list_tour'])->sum('tour_cost');
        return $data;
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