<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware('auth:api');
    }
    
    public function index()
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {

            $list = DB::table('reviews')
                    ->join('user_clients','reviews.revi_user_client','user_clients.user_id')
                    ->join('tourist_routes','reviews.revi_tourist_route','tourist_routes.tr_id')
                    ->select(DB::raw('revi_id, revi_star, revi_content, revi_time, revi_tourist_route, tr_name, revi_user_client, user_name'))
                    ->orderBy('tr_id','desc')
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
        $this->authorize('isAdmin');
        $review = Review::find($id);
        $review->delete();
        return ['message' => 'Review Deleted'];
    }
}