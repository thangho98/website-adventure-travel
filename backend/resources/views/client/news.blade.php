@extends('client.layouts.master')

@section('title', 'Team13.com - Mạng bán tour du lịch mạo hiểm trực tuyến')

@section('content')
<div id="content">
    <div style="display: none">
        <h1>Du lịch</h1>
    </div>

    <div id="news">
        <div class="wrapper">
            <div class="row">
                <div class="content-left col-lg-9">
                    <div class="title">TIN TỨC</div>
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="new-first">
                                <div class="head">
                                    <img src="{{asset('/img/news/'.$news[0]->news_poster)}}" alt="{{$news[0]->news_title}}">
                                </div>
                                <div class="body">
                                    <a class="title" href="{{asset('/clients/news/'.$news[0]->news_id)}}">{{$news[0]->news_title}}</a>
                                    <div class="time"><i class="far fa-clock"></i> {{$news[0]->news_time_post}}</div>
                                    <p class="des">{{$news[0]->news_description}}</p>
                                    <div class="author"><i class="fas fa-user-edit"></i>{{$news[0]->name}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="new-second">
                                <div class="head">
                                    <img src="{{asset('/img/news/'.$news[1]->news_poster)}}" alt="{{$news[1]->news_title}}">
                                </div>
                                <div class="body">
                                    <a class="title" href="{{asset('/clients/news/'.$news[1]->news_id)}}">{{$news[1]->news_title}}</a>
                                    <div class="time"><i class="far fa-clock"></i> {{$news[1]->news_time_post}}</div>
                                    <p class="des">{{$news[1]->news_description}}</p>
                                    <div class="author"><i class="fas fa-user-edit"></i>{{$news[1]->name}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @for($i=2; $i < count($news); $i++) <div class="new">
                        <div class="head">
                            <img src="{{asset('/img/news/'.$news[$i]->news_poster)}}" alt="{{$news[$i]->news_title}}">
                        </div>
                        <div class="body">
                            <a class="title" href="{{asset('/clients/news/'.$news[$i]->news_id)}}">{{$news[$i]->news_title}}</a>
                            <div class="time"><i class="far fa-clock"></i> {{$news[$i]->news_time_post}}</div>
                            <p class="des">{{$news[$i]->news_description}}</p>
                            <div class="author"><i class="fas fa-user-edit"></i>{{$news[$i]->name}}</div>
                        </div>
                </div>
                @endfor
            </div>

            <div class="content-right col-lg-3">
            <div id="suggestions">
                    <div class="title">CÁC TOUR ĐANG HOT</div>
                    <div class="tours">
                        <div class="tours-list">
                            <div class="row">
                                @foreach($tours_hot as $item)
                                <div class="tour-item col-lg-12 col-md-6">
                                    <div class="tour-item-wrapper">
                                        <div class="tour-header">
                                            <a href="{{asset('clients/tour/'.$item->tour_code)}}"><img class="ani-img-zoom" src="{{asset('../img/tourist-route/poster/'.$item->tr_poster)}}" alt="{{$item->tr_name}}"></a>
                                            <div class="tour-meta">
                                                <div class="tour-tag">{{$item->cate_name}}</div>
                                            </div>
                                        </div>
                                        <div class="tour-content">
                                            <div class="tour-title">
                                                <h5><a href="{{asset('clients/tour/'.$item->tour_code)}}">{{$item->tr_name}}</a></h5>
                                            </div>
                                            <div class="tour-info">
                                                <div class="left">
                                                    <div class="tour-start">
                                                        {{\Carbon\Carbon::parse($item->tour_time_start)->format('d/m/Y')}}
                                                    </div>

                                                    <div class="tour-price">
                                                        <span>{{number_format($item->tr_original_price,0,',','.')}} đ</span> {{number_format($item->tour_price,0,',','.')}} đ
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    <div class="tour-time">
                                                        {{$item->tr_time}} ngày
                                                    </div>
                                                    <div class="tour-slot">
                                                        {{$item->tr_max_slot - $item->tour_slot_book}} chổ
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
@stop

@section('script')
<script src="/client/js/library.js" type="text/javascript"></script>
<script src="/client/js/home.js" type="text/javascript"></script>
@stop