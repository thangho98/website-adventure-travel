<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TouristRoute;
use App\Models\Destination;
use App\Models\ImageTouristRoute;
use App\Models\TouristRouteDetail;

class TouristRouteController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'tr_name' => 'required|string|max:191|unique:categories,cate_name',
        //     'tr_category' => 'required|string',
        //     'tr_time' => 'required|string|max:191|unique:categories,cate_name',
        //     'tr_max_slot' => 'required|string',
        //     'tr_poster' => 'required|string',
        //     'tr_location' => 'required|string',
        // ]);
        
        $name = time().'.' . explode('/', explode(':', substr($request->tr_poster, 0, strpos($request->tr_poster, ';')))[1])[1];
        \Image::make($request->tr_poster)->save(public_path('img/tourist-route/poster/').$name);
        $request->merge(['tr_poster' => $name]);

        $touristRoute = new TouristRoute;
        $touristRoute->tr_name = $request['tr_name'];
        $touristRoute->tr_category = $request['tr_category'];
        $touristRoute->tr_time = $request['tr_time'];
        $touristRoute->tr_original_price = $request['tr_original_price'];
        $touristRoute->tr_max_slot = $request['tr_max_slot'];
        $touristRoute->tr_poster = $request['tr_poster'];
        $touristRoute->tr_location = $request['tr_location'];

        $touristRoute->save();
        
        $listDestinations = $request['tr_listDestinations'];

        foreach ($listDestinations as $key => $value) {
            $dest = new Destination;
            $dest->dest_tourist_route = $touristRoute->tr_id;
            $dest->dest_location = $value;
            $dest->save();
        }

        $images = $request['tr_fileList'];
        foreach ($images as $key => $value) {
            $name = (time().microtime(true)*10000).'.' . explode('/', explode(':', substr($value['path'], 0, strpos($value['path'], ';')))[1])[1];
            \Image::make($value['path'])->save(public_path('img/tourist-route/').$name);

            $imageTouristRoute = new ImageTouristRoute;
            $imageTouristRoute->itr_name = $name;
            $imageTouristRoute->itr_tourist_route = $touristRoute->tr_id;
            $imageTouristRoute->itr_highlight = $value['highlight'];
            $imageTouristRoute->itr_default = $value['default'];
            $imageTouristRoute->save();
        }

        $listTouristRouteDetails = $request['tr_listTouristRouteDetails'];
        foreach ($listTouristRouteDetails as $key => $value) {
            $trd = new TouristRouteDetail;
            $trd->trd_date = $value['trd_date'];
            $trd->trd_description = $value['trd_description'];
            $trd->trd_tourist_route =$touristRoute->tr_id;
            $trd->save();
        }
        
        return $touristRoute;
    

        // return TouristRoute::create([
        //     'tr_name' => $request['tr_name'],
        //     'tr_category' => $request['tr_category'],
        //     'tr_time' => $request['tr_time'],
        //     'tr_original_price' => $request['tr_original_price'],
        //     'tr_max_slot' => $request['tr_max_slot'],
        //     'tr_poster' => $request['tr_poster'],
        //     'tr_location' => $request['tr_location'],
        // ]);
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
        
    }
}