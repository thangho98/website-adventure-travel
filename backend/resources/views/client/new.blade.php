@extends('client.layouts.master')

@section('title', 'Team13.com - Mạng bán tour du lịch mạo hiểm trực tuyến')

@section('content')
<div id="content" class="pb-5">
    <div style="display: none">
        <h1>Du lịch</h1>
    </div>

    <div id="news">
        <div class="wrapper">

            <div class="row">
                <div class="content-left col-lg-9">
                    <div class="title">{{$new->news_title}}</div>
                    <div class="time" style="font-size: 13px; font-weight: 600; padding: 10px;"><i class="far fa-clock"></i> Ngày đăng: {{date("d/m/Y", strtotime($new->news_time_post))}}</div>
                    <div style="font-size: 15px; font-weight: 600; margin-bottom: 10px; padding: 10px;">{{$new->news_description}}</div>

                    <div style="text-align: center; padding: 10px;">
                        <img src="{{asset('/img/news/'.$new->news_poster)}}" alt="" width="100%">

                    </div>
                    <div id="new-content" style="text-align: justify; padding: 5px;">
                        {!!$new->news_content!!}
                    </div>
                    <div class="author" style="text-align: right; font-size: 13px;"><i class="fas fa-user-edit"></i>{{$new->name}}</div>
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
<!-- <script>
    document.getElementById('new-content').innerHTML();
</script> -->
@stop