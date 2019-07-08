<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Promotion;

class PromotionController extends Controller
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
            return Promotion::latest()->get();
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
            'prom_name' => 'required|string|max:191',
            'prom_description' => 'required|string',
            'prom_banner' => 'required|string',
            'prom_percent_promotion' => 'required|numeric'
        ]);

        $name = time().'.' . explode('/', explode(':', substr($request->prom_banner, 0, strpos($request->prom_banner, ';')))[1])[1];
        \Image::make($request->prom_banner)->save(public_path('img/promotion/').$name);
        $request->merge(['prom_banner' => $name]);

        return Promotion::create([
            'prom_name' => $request['prom_name'],
            'prom_description' => $request['prom_description'],
            'prom_banner' => $request['prom_banner'],
            'prom_percent_promotion' => $request['prom_percent_promotion']
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
        $promotion = Promotion::find($id);
        $this->validate($request,[
            'prom_name' => 'required|string|max:191',
            'prom_description' => 'required|string',
            'prom_banner' => 'required|string',
            'prom_percent_promotion' => 'required|numeric'
        ]);

        $currentPhoto = $promotion->prom_banner;
        if($request->prom_banner != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->prom_banner, 0, strpos($request->prom_banner, ';')))[1])[1];
            \Image::make($request->prom_banner)->save(public_path('img/promotion/').$name);
            $request->merge(['prom_banner' => $name]);

            
            $promotionPhoto = public_path('img/promotion/').$currentPhoto;
            if(file_exists($promotionPhoto)){
                @unlink($promotionPhoto);
            }
        }

        $promotion->update($request->all());
        return ['message' => 'Updated the promotion info'];
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
        $promotion = Promotion::find($id);
        $promotion->delete();
        return ['message' => 'Promotion Deleted'];
    }

    public function searchSelect(){
        if ($search = \Request::get('q')) {
            $promotion = Promotion::where(function($query) use ($search){
                $query->where('prom_name','LIKE',"%$search%")
                        ->orWhere('prom_id','LIKE',"%$search%");
            })->take(5)->get();
        }else{
            $promotion = Promotion::take(5)->orderBy('prom_name','asc')->get();
        }
        return $promotion;
    }
}