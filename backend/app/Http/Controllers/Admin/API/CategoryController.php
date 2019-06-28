<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoryController extends Controller
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
            return Category::latest()->paginate(5);
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
        $this->validate($request,[
            'cate_name' => 'required|string|max:191|unique:categories,cate_name',
            'cate_image' => 'required|string'
        ]);

        $name = time().'.' . explode('/', explode(':', substr($request->cate_image, 0, strpos($request->cate_image, ';')))[1])[1];
        \Image::make($request->cate_image)->save(public_path('img/category/').$name);
        $request->merge(['cate_image' => $name]);

        return Category::create([
            'cate_name' => $request['cate_name'],
            'cate_image' => $request['cate_image']
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
        $cate = Category::findOrFail($id);
        $this->validate($request,[
            'cate_name' => 'required|string|max:191|unique:categories,cate_name,'.$id.',cate_id',
            'cate_image' => 'required|string'
        ]);

        $currentPhoto = $cate->cate_image;
        if($request->cate_image != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->cate_image, 0, strpos($request->cate_image, ';')))[1])[1];
            \Image::make($request->cate_image)->save(public_path('img/category/').$name);
            $request->merge(['cate_image' => $name]);

            
            $catePhoto = public_path('img/category/').$currentPhoto;
            if(file_exists($catePhoto)){
                @unlink($catePhoto);
            }
        }

        $cate->update($request->all());
        return ['message' => 'Updated the category info'];
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
        $cate = Category::findOrFail($id);
        // delete the user
        $cate->delete();
        return ['message' => 'Category Deleted'];
    }

    public function getListCategories(){
        return Category::all();
    }
}