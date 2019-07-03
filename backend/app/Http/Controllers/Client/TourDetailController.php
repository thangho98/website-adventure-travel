<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TourDetailController extends Controller
{
    //
    public function Index($code)
    {
        $data['code'] = $code;
        $data['tour_detail'] = $this->getDetail($code);
        $data['tour_images'] = $this->getImages($code);
        $data['tour_schedules'] = $this->getSchedules($code);
        $data['tours_hot'] = $this->getToursHot();
        $data['destinations'] = $this->getDestination($code);
        $data['orther_days'] = $this->getOtherDays($code);
        $data['comments'] = $this->getComments($code);
        $data['review_score'] = $this->getReviewScore($code);

        return view('client.tour_detail', $data);
    }

    public function getDetail($code)
    {
        $data = DB::table('tours')
            ->where('tour_code', $code)
            ->join('tourist_routes',  'tour_tourist_route', 'tr_id')
            ->join('categories', 'tr_category', 'cate_id')
            ->join('locations', 'tr_location', 'loca_id')
            ->get();
        return $data;
    }

    public function getImages($code)
    {
        $data = DB::table('tours')
            ->where('tour_code', $code)
            ->rightJoin('image_tourist_routes', 'tour_tourist_route', 'itr_tourist_route')
            ->get();
        return $data;
    }

    public function getSchedules($code)
    {
        $data = DB::table('tours')
            ->where('tour_code', $code)
            ->rightJoin('tourist_route_details', 'tour_tourist_route', 'trd_tourist_route')
            ->orderBy('trd_date')
            ->get();
        return $data;
    }

    public function getToursHot()
    {
        $data = DB::table('tours')
            ->join('tourist_routes', 'tour_tourist_route', 'tr_id')
            ->join('categories', 'tr_category', 'cate_id')
            ->orderBy('tour_time_start')
            ->take(4)
            ->get();

        return $data;
    }

    public function getDestination($code)
    {
        $data = DB::table('tours')
            ->where('tour_code', $code)
            ->join('destinations', 'tour_tourist_route', 'dest_tourist_route')
            ->join('locations', 'dest_location', 'loca_id')
            ->get();

        return $data;
    }

    public function getOtherDays($code)
    {
        $data1 = DB::table('tours')
            ->where('tour_code', $code)
            ->get();

        $data2 = DB::table('tours')
            ->where('tour_tourist_route', $data1->first()->tour_tourist_route)
            ->join('tourist_routes', 'tour_tourist_route', 'tr_id')
            ->orderBy('tour_time_start')
            ->get();

        return $data2;
    }

    public function getComments($code)
    {
        $data = DB::table('tours')
            ->where('tour_code', $code)
            ->join('reviews', 'tour_tourist_route', 'revi_tourist_route')
            ->join('user_clients', 'revi_user_client', 'user_id')
            ->orderByDesc('revi_time')
            ->get();

        return $data;
    }

    public function postComment(Request $request, $code)
    {
        $data1 = DB::table('tours')
            ->where('tour_code', $code)
            ->get();

        $comment = new Review;
        $comment->revi_star = $request->score;
        $comment->revi_content = $request->comment_content;
        $comment->revi_time = Carbon::now()->toDateTimeString();
        $comment->revi_tourist_route = $data1->first()->tour_tourist_route;
        $comment->revi_user_client = Auth::guard('client')->user()->user_id;
        $comment->save();

        return back();
    }

    public function getReviewScore($code)
    {
        $data['score'] = DB::table('tours')
            ->where('tour_code', $code)
            ->join('reviews', 'tour_tourist_route', 'revi_tourist_route')
            ->select(DB::raw('avg(revi_star) as avg'))
            ->get()
            ->first()
            ->avg;

        if ($data['score'] <= 1)
            $data['score_text'] = 'Khủng khiếp';
        else if ($data['score'] <= 2)
            $data['score_text'] = 'Tệ';
        else if ($data['score'] <= 3)
            $data['score_text'] = 'Trung bình';
        else if ($data['score'] <= 4)
            $data['score_text'] = 'Good';
        else if ($data['score'] <= 5)
            $data['score_text'] = 'Tuyệt vời';

        $data['count_comments'] = DB::table('tours')
            ->where('tour_code', $code)
            ->join('reviews', 'tour_tourist_route', 'revi_tourist_route')
            ->select(DB::raw('count(revi_id) as count'))
            ->get()
            ->first()
            ->count;

        for ($i = 1; $i <= 5; $i++) {
            $data['review_chart'][$i]['count'] = DB::table('tours')
                ->where('tour_code', $code)
                ->join('reviews', 'tour_tourist_route', 'revi_tourist_route')
                ->where('revi_star', $i)
                ->select(DB::raw('count(revi_id) as count'))
                ->get()
                ->first()
                ->count;

            $data['review_chart'][$i]['percent'] = $data['review_chart'][$i]['count'] / $data['count_comments'] * 100;

            if ($i == 1)
                $data['review_chart'][$i]['text'] = 'Khủng khiếp';
            else if ($i == 2)
                $data['review_chart'][$i]['text'] = 'Tệ';
            else if ($i == 3)
                $data['review_chart'][$i]['text'] = 'Trung bình';
            else if ($i == 4)
                $data['review_chart'][$i]['text'] = 'Good';
            else if ($i == 5)
                $data['review_chart'][$i]['text'] = 'Tuyệt vời';
        }

        return $data;
    }
}
