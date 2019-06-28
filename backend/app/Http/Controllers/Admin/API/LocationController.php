<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Location;

class LocationController extends Controller
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
            return Location::latest()->paginate(5);
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
        $this->validate($request,[
            'loca_name' => 'required|string|max:191',
            'loca_description' => 'required|string',
            'loca_poster' => 'required|string'
        ]);

        $name = time().'.' . explode('/', explode(':', substr($request->loca_poster, 0, strpos($request->loca_poster, ';')))[1])[1];
        \Image::make($request->loca_poster)->save(public_path('img/location/').$name);
        $request->merge(['loca_poster' => $name]);

        return Location::create([
            'loca_name' => $request['loca_name'],
            'loca_description' => $request['loca_description'],
            'loca_poster' => $request['loca_poster']
        ]);
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
        $location = Location::findOrFail($id);
        $this->validate($request,[
            'loca_name' => 'required|string|max:191',
            'loca_description' => 'required|string',
            'loca_poster' => 'required|string'
        ]);

        $currentPhoto = $location->loca_poster;
        if($request->loca_poster != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->loca_poster, 0, strpos($request->loca_poster, ';')))[1])[1];
            \Image::make($request->loca_poster)->save(public_path('img/location/').$name);
            $request->merge(['loca_poster' => $name]);

            
            $locationPhoto = public_path('img/location/').$currentPhoto;
            if(file_exists($locationPhoto)){
                @unlink($locationPhoto);
            }
        }

        $location->update($request->all());
        return ['message' => 'Updated the location info'];
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
        $location = Location::findOrFail($id);
        // delete the user
        $location->delete();
        return ['message' => 'Location Deleted'];
    }

    public function searchSelect(){
        if ($search = \Request::get('q')) {
            $locations = Location::where(function($query) use ($search){
                $query->where('loca_name','LIKE',"%$search%")
                        ->orWhere('loca_id','LIKE',"%$search%")
                        ->orWhere('loca_description','LIKE',"%$search%");
            })->take(5)->get();
        }else{
            $locations = Location::take(5)->orderBy('loca_name','asc')->get();
        }
        return $locations;
    }
}