<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Location;
use App\Models\TouristRoute;
use App\Models\Destination;
use App\Models\ImageTouristRoute;
use App\Models\TouristRouteDetail;
use DB;

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
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {

            //$list = TouristRoute::latest()->paginate(5);

            $list = DB::table('tourist_routes')
                    ->join('categories','tourist_routes.tr_category','categories.cate_id')
                    ->join('locations','tourist_routes.tr_location','locations.loca_id')
                    ->select(DB::raw('tr_id, tr_name, tr_category, cate_name, tr_time, tr_original_price, tr_max_slot, tr_poster, tr_location, loca_name'))
                    ->orderBy('tr_id','desc')
                    ->paginate(5);

            // foreach ($list->data as $key => $value) {
            //     # code...
            // }
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
        $touristRoute->tr_introduction = $request['tr_introduction'];
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
        $data['tourist_route'] = TouristRoute::find($id);

        $cate = $data['tourist_route']->tr_category;
        $location =  $data['tourist_route']->tr_location;

        $data['tourist_route']->tr_category = Category::find($cate);
        $data['tourist_route']->tr_location = Location::find($location);
       
        $data['list_tourist_route_details'] = TouristRouteDetail::where('trd_tourist_route',$id)
        ->select(DB::raw('trd_date, trd_description'))
        ->get();
        
        $listDes = Destination::where('dest_tourist_route',$id)->get();

        foreach ($listDes as $key => $value) {
            $data['list_destinations'][$key]= Location::find($value['dest_location']);
        }

        $listImage = ImageTouristRoute::where('itr_tourist_route',$id)
        ->select(DB::raw('itr_id, itr_name, itr_default, itr_highlight'))
        ->get();
        foreach ($listImage as $key => $value) {
            $data['list_image_tourist'][$key]= [
                'itr_id' => $value['itr_id'],
                'path' => url('/img/tourist-route/').'/'.$value['itr_name'],
                'default' => $value['itr_default'],
                'highlight' => $value['itr_highlight'],
                'caption' => 'caption to display. receive'
            ];
        }

        //$data['list_image_tourist'];

        //$data['list_destinations'];
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
        $touristRoute = TouristRoute::findOrFail($id);
        
        $currentPhoto = $touristRoute->tr_poster;
        if($request->tr_poster != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->tr_poster, 0, strpos($request->tr_poster, ';')))[1])[1];
            \Image::make($request->tr_poster)->save(public_path('img/tourist-route/poster/').$name);
            $request->merge(['tr_poster' => $name]);

            $poster = public_path('img/tourist-route/poster/').$currentPhoto;
            if(file_exists($poster)){
                @unlink($poster);
            }
        }

        $touristRoute->tr_name = $request['tr_name'];
        $touristRoute->tr_category = $request['tr_category']['cate_id'];
        $touristRoute->tr_introduction = $request['tr_introduction'];
        $touristRoute->tr_time = $request['tr_time'];
        $touristRoute->tr_original_price = $request['tr_original_price'];
        $touristRoute->tr_max_slot = $request['tr_max_slot'];
        $touristRoute->tr_poster = $request['tr_poster'];
        $touristRoute->tr_location = $request['tr_location']['loca_id'];

        $touristRoute->save();

        $listDes = Destination::where('dest_tourist_route',$id)->get();
        foreach ($listDes as $key => $value) {
            Destination::destroy($value['dest_id']);
        }
        
        $listDestinations = $request['tr_listDestinations'];
        foreach ($listDestinations as $key => $value) {
            $dest = new Destination;
            $dest->dest_tourist_route = $touristRoute->tr_id;
            $dest->dest_location = $value['loca_id'];
            $dest->save();
        }

        $listDetail = TouristRouteDetail::where('trd_tourist_route',$id)
            ->get();
        foreach ($listDetail as $key => $value) {
            TouristRouteDetail::destroy($value['trd_id']);
        }

        $listTouristRouteDetails = $request['tr_listTouristRouteDetails'];
        foreach ($listTouristRouteDetails as $key => $value) {
            $trd = new TouristRouteDetail;
            $trd->trd_date = $value['trd_date'];
            $trd->trd_description = $value['trd_description'];
            $trd->trd_tourist_route =$touristRoute->tr_id;
            $trd->save();
        }

        $listImage = ImageTouristRoute::where('itr_tourist_route',$id)
            ->get();
        
        $images = $request['tr_fileList'];
        foreach ($images as $key => $value) {
            if(!empty($value['itr_id'])){

                //lưu vết lại những đối tượng đã được chỉnh sửa
                $his[$key] = $value['itr_id'];

                $imageTouristRoute = ImageTouristRoute::findOrFail($value['itr_id']);

                $currentImage = $imageTouristRoute->itr_name;
                //kiem tra chuoi mot co chua chuoi hai khong
                if(strpos($value['path'], $currentImage) == false){
                    $nameImage = time().'.' . explode('/', explode(':', substr($value['path'], 0, strpos($value['path'], ';')))[1])[1];
                    \Image::make($value['path'])->save(public_path('img/tourist-route/').$nameImage);

                    $img = public_path('img/tourist-route/').$currentImage;
                    if(file_exists($img)){
                        @unlink($img);
                    }

                    $imageTouristRoute->itr_name = $nameImage;
                }
                $imageTouristRoute->itr_highlight = $value['highlight'];
                $imageTouristRoute->itr_default = $value['default'];
                $imageTouristRoute->save();
            }
            else{
                $name = (time().microtime(true)*10000).'.' . explode('/', explode(':', substr($value['path'], 0, strpos($value['path'], ';')))[1])[1];
                \Image::make($value['path'])->save(public_path('img/tourist-route/').$name);

                $imageTouristRoute = new ImageTouristRoute;
                $imageTouristRoute->itr_name = $name;
                $imageTouristRoute->itr_tourist_route = $touristRoute->tr_id;
                $imageTouristRoute->itr_highlight = $value['highlight'];
                $imageTouristRoute->itr_default = $value['default'];
                $imageTouristRoute->save();
            }
        }

        foreach ($listImage as $key => $value) {
            $isDelete = true;
            foreach ($his as $key1 => $value1) {
               if($value['itr_id'] == $value1){
                $isDelete = false;
               }
            }
            if($isDelete){
                ImageTouristRoute::destroy($value['itr_id']);
            }
        }
        
        return $request->all();
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
        $tourist = TouristRoute::findOrFail($id);
        $tourist->delete();
        return ['message' => 'Tourist Route Deleted'];
    }
    public function searchSelect(){
        if ($search = \Request::get('q')) {
            $touristRoute = TouristRoute::where(function($query) use ($search){
                $query->where('tr_name','LIKE',"%$search%")
                        ->orWhere('tr_id','LIKE',"%$search%");
            })->take(5)->get();
        }else{
            $touristRoute = TouristRoute::take(5)->orderBy('tr_name','asc')->get();
        }
        return $touristRoute;
    }
}