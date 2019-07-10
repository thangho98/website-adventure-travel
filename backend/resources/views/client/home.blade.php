@extends('client.layouts.master')

@section('title', 'Team13.com - Mạng bán tour du lịch mạo hiểm trực tuyến')

@section('content')
<div id="content">
    <div style="display: none">
        <h1>Du lịch</h1>
    </div>

    <div id="tours-gio-chot" class="tours">
        <div class="tours-title">
            <a href="#">
                <h2>TOUR GIỜ CHÓT</h2>
            </a>
        </div>
        <div class="tours-list">
            <div class="wrapper">
                <div class="tour-item">
                    <div class="tour-item-wrapper row">
                        <div class="tour-header col-md-6">
                            <a href="{{asset('clients/tour/'.$tours_last_hour[0]->tour_code)}}"><img class="ani-img-zoom" src="{{asset('/img/tourist-route/poster/'.$tours_last_hour[0]->tr_poster)}}" alt="{{$tours_last_hour[1]->tr_name}}"></a>
                            <div class="tour-meta">
                                <div class="tour-tag">{{$tours_last_hour[0]->cate_name}}</div>
                            </div>
                        </div>
                        <div class="tour-content col-md-6">
                            <div class="tour-title">
                                <h5><a href="{{asset('clients/tour/'.$tours_last_hour[0]->tour_code)}}">{{$tours_last_hour[0]->tr_name}}</a></h5>
                            </div>
                            <div class="tour-info">
                                <div class="tour-info-top">
                                    <div class="left">
                                        <div class="tour-start">
                                            Khởi hành: {{\Carbon\Carbon::parse($tours_last_hour[0]->tour_time_start)->format('d/m/Y')}}
                                        </div>

                                        <div class="tour-location">
                                            Nơi khởi hành: {{$tours_last_hour[0]->loca_name}}
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            Số ngày: {{$tours_last_hour[0]->tr_time}} ngày
                                        </div>
                                        <div class="tour-slot">
                                            Số chổ còn nhận: {{$tours_last_hour[0]->tr_max_slot - $tours_last_hour[0]->tour_slot_book}}
                                        </div>
                                    </div>
                                </div>


                                <div class="tour-price">
                                    <span>{{number_format($tours_last_hour[0]->tr_original_price)}}</span> {{number_format($tours_last_hour[0]->tour_price)}} đ
                                </div>

                                <div class="tour-time-remain">
                                    <a href="{{asset('clients/tour/'.$tours_last_hour[0]->tour_code)}}">ĐẶT VÉ NGAY</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tour-item">
                    <div class="tour-item-wrapper row">

                        <div class="tour-content col-md-6">
                            <div class="tour-title">
                                <h5><a href="{{asset('clients/tour/'.$tours_last_hour[1]->tour_code)}}">{{$tours_last_hour[1]->tr_name}}</a></h5>
                            </div>
                            <div class="tour-info">
                                <div class="tour-info-top">
                                    <div class="left">
                                        <div class="tour-start">
                                            Khởi hành: {{\Carbon\Carbon::parse($tours_last_hour[1]->tour_time_start)->format('d/m/Y')}}
                                        </div>

                                        <div class="tour-location">
                                            Nơi khởi hành: {{$tours_last_hour[1]->loca_name}}
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            Số ngày: {{$tours_last_hour[1]->tr_time}} ngày
                                        </div>
                                        <div class="tour-slot">
                                            Số chổ còn nhận: {{$tours_last_hour[1]->tr_max_slot - $tours_last_hour[1]->tour_slot_book}}
                                        </div>
                                    </div>
                                </div>


                                <div class="tour-price">
                                    <span>{{number_format($tours_last_hour[1]->tr_original_price)}}</span> {{number_format($tours_last_hour[1]->tour_price)}} đ
                                </div>

                                <div class="tour-time-remain">
                                    <a href="{{asset('clients/tour/'.$tours_last_hour[1]->tour_code)}}">ĐẶT VÉ NGAY</a>
                                </div>
                            </div>
                        </div>
                        <div class="tour-header col-md-6">
                            <a href="{{asset('clients/tour/'.$tours_last_hour[1]->tour_code)}}"><img class="ani-img-zoom" src="{{asset('/img/tourist-route/poster/'.$tours_last_hour[1]->tr_poster)}}" alt="{{$tours_last_hour[1]->tr_name}}"></a>
                            <div class="tour-meta">
                                <div class="tour-tag">{{$tours_last_hour[1]->cate_name}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn-more"><a href="{{route('toursLastHour')}}">Xem thêm</a></button>
        </div>
    </div>

    <div id="banner-khuyen-mai" class="tours">
        <a href="#"><img src="/client/imgs/slide2.jpg" alt="Khuyến mãi"></a>
    </div>

    <div id="tours-dang-hot" class="tours">
        <div class="tours-title">
            <a href="#">
                <h2>TOURS ĐANG HOT</h2>
            </a>
        </div>
        <div class="tours-list">
            <div class="wrapper">
                <div class="row">
                    @for($i = 0; $i < count($tours_hot); $i++) <div class="tour-item col-lg-3 col-md-6">
                        <div class="tour-item-wrapper">
                            <div class="tour-header">
                                <a href="{{asset('clients/tour/'.$tours_hot[$i]->tour_code)}}"><img class="ani-img-zoom" src="{{asset('/img/tourist-route/poster/'.$tours_hot[$i]->tr_poster)}}" alt="{{$tours_hot[$i]->tr_name}}"></a>
                                <div class="tour-meta">
                                    <div class="tour-tag">{{$tours_hot[$i]->cate_name}}</div>
                                </div>
                            </div>
                            <div class="tour-content">
                                <div class="tour-title">
                                    <h5><a href="{{asset('clients/tour/'.$tours_hot[$i]->tour_code)}}">{{$tours_hot[$i]->tr_name}}</a></h5>
                                </div>
                                <div class="tour-info">
                                    <div class="left">
                                        <div class="tour-start">
                                            {{\Carbon\Carbon::parse($tours_hot[$i]->tour_time_start)->format('d/m/Y')}}
                                        </div>

                                        <div class="tour-price">
                                            <span>{{number_format($tours_hot[$i]->tr_original_price)}}</span> {{number_format($tours_hot[$i]->tour_price)}} đ
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            {{$tours_hot[$i]->tr_time}} ngày
                                        </div>
                                        <div class="tour-slot">
                                            {{$tours_hot[$i]->tr_max_slot - $tours_hot[$i]->tour_slot_book}} chổ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endfor
            </div>
        </div>
        <button class="btn-more"><a href="{{route('toursHot')}}">Xem thêm</a></button>
    </div>


</div>

<div id="tours-pho-bien-nhat" class="tours">
    <div class="tours-title">
        <a href="#">
            <h2>TOURS MỚI NHẤT</h2>
        </a>
    </div>
    <div class="tours-list">
        <div class="wrapper">
            <div class="row">
                @for($i = 0; $i < count($tours_latest); $i++) <div class="tour-item col-lg-3 col-md-6">
                    <div class="tour-item-wrapper">
                        <div class="tour-header">
                            <a href="{{asset('clients/tour/'.$tours_latest[$i]->tour_code)}}"><img class="ani-img-zoom" src="{{asset('/img/tourist-route/poster/'.$tours_latest[$i]->tr_poster)}}" alt="{{$tours_latest[$i]->tr_name}}"></a>
                            <div class="tour-meta">
                                <div class="tour-tag">{{$tours_latest[$i]->cate_name}}</div>
                            </div>
                        </div>
                        <div class="tour-content">
                            <div class="tour-title">
                                <h5><a href="{{asset('clients/tour/'.$tours_latest[$i]->tour_code)}}">{{$tours_latest[$i]->tr_name}}</a></h5>
                            </div>
                            <div class="tour-info">
                                <div class="left">
                                    <div class="tour-start">
                                        {{\Carbon\Carbon::parse($tours_latest[$i]->tour_time_start)->format('d/m/Y')}}
                                    </div>

                                    <div class="tour-price">
                                        <span>{{number_format($tours_latest[$i]->tr_original_price)}}</span> {{number_format($tours_latest[$i]->tour_price)}} đ
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="tour-time">
                                        {{$tours_latest[$i]->tr_time}} ngày
                                    </div>
                                    <div class="tour-slot">
                                        {{$tours_latest[$i]->tr_max_slot - $tours_latest[$i]->tour_slot_book}} chổ
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endfor
        </div>
    </div>
    <button class="btn-more"><a href="{{route('toursLatest')}}">Xem thêm</a></button>
</div>
</div>

<div id="popular-activity" class="tours">
    <div class="tours-title">
        <a href="#">
            <h2>HOẠT ĐỘNG PHỔ BIẾN</h2>
        </a>
    </div>
    <div class="activity-wrapper tours-list">
        <div class="wrapper">
            <div class="row">
                @foreach($categories as $item)
                <div class="activity-item col-lg-3 col-md-6">
                    <a href="{{asset('clients/hoat-dong/'.$item->cate_id)}}">
                        <div class="activity-img">
                            <img class="ani-img-zoom" src="{{asset('/img/category/'.$item->cate_image)}}" alt="{{$item->cate_name}}">
                        </div>
                        <div class="activity-title">
                            <h4 class="title">{{$item->cate_name}}</h4>
                        </div>
                        <!-- <button class="btn-activity">12 tours</button> -->
                    </a>
                </div>
                @endforeach
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