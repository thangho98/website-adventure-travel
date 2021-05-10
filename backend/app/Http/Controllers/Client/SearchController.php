<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Tour;
use App\Models\TouristRoute;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\Location;
use App\Models\Destination;
use App\Models\TouristRouteDetail;
use App\Models\Review;
use DB;

class SearchController extends Controller
{
    public function getSearch(Request $request)
    {
        $starting_gate = $request['starting_gate'];
        $destination = $request['destination'];
        $departure_date = date_create($request['departure_date']);
        $category = $request['category'];
        $price = $request['price'];

        $data = $this->search($starting_gate, $destination, $departure_date, $category, $price, null, null);
        
        //dd($data);
        return view('client.search',$data);
    }

    public function getSearchAjax(Request $request)
    {
        $starting_gate = $request['starting_gate'];
        $destination = $request['destination'];
        $departure_date = date_create($request['departure_date']);
        $category = $request['category'];
        $price = $request['price'];
        $price_order = $request['price_order'];
        $status_order = $request['status_order'];

        $data = $this->search($starting_gate, $destination, $departure_date, $category, $price, $price_order, $status_order);
        
        //dd($data);
        return view('client.list_tour_search',$data);
    }

    public function subDate($date2, $date1)
    {
        $datetime2 = strtotime($date2);
        $datetime1 = strtotime($date1);
        $secs = $datetime2 - $datetime1;// == return sec in difference
        return $secs / 86400;
    }

    public function search($starting_gate, $destination, $departure_date, $category, $price, $price_order, $status_order)
    {
        $currentDate = date("Y-m-d");
        $date_query = date('Y-m-d' ,strtotime($currentDate. ' + 2 day'));
        
        if($currentDate < $departure_date){
            if($this->subDate(date_format($departure_date,"Y/m/d"),$currentDate) > 2){
                $date_query = date_format($departure_date,"Y-m-d");
            }
        }

        $query = DB::table('tours')
                    ->join('tourist_routes','tourist_routes.tr_id','tours.tour_tourist_route')
                    ->join('destinations','destinations.dest_tourist_route','tourist_routes.tr_id')
                    ->join('locations','locations.loca_id','destinations.dest_location')
                    ->where('tour_time_start','>=',$date_query)
                    ->where('tour_status', 0);
                    
        $data['starting_gate'] = $starting_gate;
        $data['destination'] = $destination;
        
        if($price != 'all'){
            if($price == '>20000000'){
                $query->where('tour_price','>',20000000);
            }
            else{
                $arr = explode("-",$price);
                $query->whereBetween('tour_price', $arr);
            }
        }

        if($starting_gate != 'all'){
            $query->where('tr_location',$starting_gate);
            $data['starting_gate'] = Location::find($starting_gate);
        }
                    
        if($destination != 'all'){
            $query->where('loca_id',$destination);
            $data['destination'] = Location::find($destination);
        }

        if($category != 'all'){
            $query->where('tr_category',$category);
        }

        if(!empty($price_order)){
            $query->orderBy('tour_price',$price_order);
        }

        $dataQuery = $query->groupBy('tour_id')->orderBy('tour_time_start','asc')->get();

        foreach ($dataQuery as $key => $value) {
            if(!empty($status_order)){
                $slot = $value->tr_max_slot - $value->tour_slot_book;
                
                if($status_order == "still"){
                    if($slot <= 0){
                        continue;
                    }
                }else{
                    if($slot > 0){
                        continue;
                    }
                }
            }
            
            $data['list_tours'][$key]['tour'] = Tour::find($value->tour_id);
            $data['list_tours'][$key]['tourist_routes'] = TouristRoute::find($value->tr_id);
            $data['list_tours'][$key]['promotion'] = Promotion::find($value->tour_promotion);
            $data['list_tours'][$key]['category'] = Category::find($value->tr_category);
            $data['list_tours'][$key]['location'] = Location::find($value->tr_location);
            $avg = Review::where('revi_tourist_route',$value->tr_location)->avg('revi_star');
            
            if(!empty($avg)){
                $data['list_tours'][$key]['avg_review'] = $avg;
            }
            else{
                $data['list_tours'][$key]['avg_review'] = 0;
            }

            $count = Review::where('revi_tourist_route',$value->tr_location)->get();
            
            if(!empty($count)){
                $data['list_tours'][$key]['count_review'] = count($count);
            }
            else{
                $data['list_tours'][$key]['count_review'] = 0;
            }
            
            //$data['list_tours'][$key]['destinations'] = Destination::where('dest_tourist_route',$value->tr_id)->get();
        }

        return $data;
    }
}