<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Models\News;
use Auth;

class NewsController extends Controller
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

            $list = DB::table('news')
                    ->join('users','news.news_user_admin','users.id')
                    ->orderBy('news_id','desc')
                    ->paginate(5);

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
        $this->validate($request,[
            'news_title' => 'required|string|max:191',
            'news_description' => 'required|string',
            'news_poster' => 'required|string',
            'news_content' => 'required|string'
        ]);

        $name = time().'.' . explode('/', explode(':', substr($request->news_poster, 0, strpos($request->news_poster, ';')))[1])[1];
        \Image::make($request->news_poster)->save(public_path('img/news/').$name);
        $request->merge(['news_poster' => $name]);

        return News::create([
            'news_title' => $request['news_title'],
            'news_description' => $request['news_description'],
            'news_poster' => $request['news_poster'],
            'news_content' => $request['news_content'],
            'news_time_post'=>  date("Y-m-d"),
            'news_user_admin'=> auth('api')->user()->id,
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
        return News::findOrFail($id);
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
        $this->validate($request,[
            'news_title' => 'required|string|max:191',
            'news_description' => 'required|string',
            'news_poster' => 'required|string',
            'news_content' => 'required|string'
        ]);

        $news = News::findOrFail($id);

        $currentPhoto = $news->news_poster;
        if($request->news_poster != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->news_poster, 0, strpos($request->news_poster, ';')))[1])[1];
            \Image::make($request->news_poster)->save(public_path('img/news/').$name);
            $request->merge(['news_poster' => $name]);

            
            $newsPhoto = public_path('img/news/').$currentPhoto;
            if(file_exists($newsPhoto)){
                @unlink($newsPhoto);
            }
        }

        $news->news_title = $request['news_title'];
        $news->news_description = $request['news_description'];
        $news->news_poster = $request['news_poster'];
        $news->news_content = $request['news_content'];
        
        $news->save();

        return ['message' => 'Updated the news info'];
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
        $news = News::findOrFail($id);
        $news->delete();
        return ['message' => 'News Deleted'];
    }
}