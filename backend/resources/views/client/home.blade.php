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
                            <a href=""><img class="ani-img-zoom" src="/client/imgs/1.jpg" alt=""></a>
                            <div class="tour-meta">
                                <div class="tour-tag">Leo núi</div>
                            </div>
                        </div>
                        <div class="tour-content col-md-6">
                            <div class="tour-title">
                                <h5><a href="">Tour Hà Nội - Nga - Pháp - Anh</a></h5>
                            </div>
                            <div class="tour-info">
                                <div class="tour-info-top">
                                    <div class="left">
                                        <div class="tour-start">
                                            Khởi hành: 01/07/2019 07:00
                                        </div>

                                        <div class="tour-location">
                                            Nơi khởi hành: Hồ Chí Minh
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            Số ngày: 3 ngày
                                        </div>
                                        <div class="tour-slot">
                                            Số chổ còn nhận: 5
                                        </div>
                                    </div>
                                </div>


                                <div class="tour-price">
                                    <span>4.500.000</span> 3.500.000 đ
                                </div>

                                <div class="tour-time-remain">
                                    <i class="far fa-clock"></i> Còn 00 ngày 15:20:50
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tour-item">
                    <div class="tour-item-wrapper row">

                        <div class="tour-content col-md-6">
                            <div class="tour-title">
                                <h5><a href="">Tour Hà Nội - Nga - Pháp - Anh</a></h5>
                            </div>
                            <div class="tour-info">
                                <div class="tour-info-top">
                                    <div class="left">
                                        <div class="tour-start">
                                            Khởi hành: 01/07/2019 07:00
                                        </div>

                                        <div class="tour-location">
                                            Nơi khởi hành: Hồ Chí Minh
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            Số ngày: 3 ngày
                                        </div>
                                        <div class="tour-slot">
                                            Số chổ còn nhận: 5
                                        </div>
                                    </div>
                                </div>


                                <div class="tour-price">
                                    <span>4.500.000</span> 3.500.000 đ
                                </div>

                                <div class="tour-time-remain">
                                    <i class="far fa-clock"></i> Còn 00 ngày 15:20:50
                                </div>
                            </div>

                        </div>
                        <div class="tour-header col-md-6">
                            <a href=""><img class="ani-img-zoom" src="/client/imgs/2.jpg" alt=""></a>
                            <div class="tour-meta">
                                <div class="tour-tag">Leo núi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn-more">Xem thêm</button>
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
                    @foreach($tours_hot as $item)
                    <div class="tour-item col-lg-3 col-md-6">
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
                                            {{$item->tour_time_start}}
                                        </div>

                                        <div class="tour-price">
                                            <span>{{number_format($item->tr_original_price)}}</span> {{number_format($item->tour_price)}} đ
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
            <button class="btn-more">Xem thêm</button>
        </div>
    </div>

    <div id="tours-pho-bien-nhat" class="tours">
        <div class="tours-title">
            <a href="#">
                <h2>TOURS PHỔ BIẾN NHẤT</h2>
            </a>
        </div>
        <div class="tours-list">
            <div class="wrapper">
                <div class="row">
                    <div class="tour-item col-lg-3 col-md-6">
                        <div class="tour-item-wrapper">
                            <div class="tour-header">
                                <a href=""><img class="ani-img-zoom" src="/client/imgs/1.jpg" alt=""></a>
                                <div class="tour-meta">
                                    <div class="tour-tag">Leo núi</div>
                                </div>
                            </div>
                            <div class="tour-content">
                                <div class="tour-title">
                                    <h5><a href="">Tour Hà Nội - Nga - Pháp - Anh</a></h5>
                                </div>
                                <div class="tour-info">
                                    <div class="left">
                                        <div class="tour-start">
                                            01/07/2019 07:00
                                        </div>

                                        <div class="tour-price">
                                            <span>4.500.000</span> 3.500.000 đ
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            3 ngày
                                        </div>
                                        <div class="tour-slot">
                                            5 chổ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour-item col-lg-3 col-md-6">
                        <div class="tour-item-wrapper">
                            <div class="tour-header">
                                <a href=""><img class="ani-img-zoom" src="/client/imgs/2.jpg" alt=""></a>
                                <div class="tour-meta">
                                    <div class="tour-tag">Leo núi</div>
                                </div>
                            </div>
                            <div class="tour-content">
                                <div class="tour-title">
                                    <h5><a href="">Tour Hà Nội - Nga - Pháp - Anh</a></h5>
                                </div>
                                <div class="tour-info">
                                    <div class="left">
                                        <div class="tour-start">
                                            01/07/2019 07:00
                                        </div>

                                        <div class="tour-price">
                                            <span>4.500.000</span> 3.500.000 đ
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            3 ngày
                                        </div>
                                        <div class="tour-slot">
                                            5 chổ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour-item col-lg-3 col-md-6">
                        <div class="tour-item-wrapper">
                            <div class="tour-header">
                                <a href=""><img class="ani-img-zoom" src="/client/imgs/3.jpg" alt=""></a>
                                <div class="tour-meta">
                                    <div class="tour-tag">Leo núi</div>
                                </div>
                            </div>
                            <div class="tour-content">
                                <div class="tour-title">
                                    <h5><a href="">Tour Hà Nội - Nga - Pháp - Anh</a></h5>
                                </div>
                                <div class="tour-info">
                                    <div class="left">
                                        <div class="tour-start">
                                            01/07/2019 07:00
                                        </div>

                                        <div class="tour-price">
                                            <span>4.500.000</span> 3.500.000 đ
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            3 ngày
                                        </div>
                                        <div class="tour-slot">
                                            5 chổ
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tour-item col-lg-3 col-md-6">
                        <div class="tour-item-wrapper">
                            <div class="tour-header">
                                <a href=""><img class="ani-img-zoom" src="/client/imgs/4.jpg" alt=""></a>
                                <div class="tour-meta">
                                    <div class="tour-tag">Leo núi</div>
                                </div>
                            </div>
                            <div class="tour-content">
                                <div class="tour-title">
                                    <h5><a href="">Tour Hà Nội - Nga - Pháp - Anh</a></h5>
                                </div>
                                <div class="tour-info">
                                    <div class="left">
                                        <div class="tour-start">
                                            01/07/2019 07:00
                                        </div>

                                        <div class="tour-price">
                                            <span>4.500.000</span> 3.500.000 đ
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="tour-time">
                                            3 ngày
                                        </div>
                                        <div class="tour-slot">
                                            5 chổ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn-more">Xem thêm</button>
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
                        <a href="">
                            <div class="activity-img">
                                <img class="ani-img-zoom" src="{{asset('../img/category/'.$item->cate_image)}}" alt="{{$item->cate_name}}">
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