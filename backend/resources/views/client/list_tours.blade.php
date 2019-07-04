@extends('client.layouts.master')

@section('title', 'Team13.com - '.$tit)

@section('content')
<div id="content">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-9">
                <div id="search-results">
                    <div class="title">
                        <h1>{{$title}}</h1>
                    </div>

                    <!-- <div class="des">
                        Vịnh Hạ Long nơi rồng đáp xuống, là danh thắng quốc gia được xếp hạng từ năm 1962. Hạ
                        Long
                        có 1.969 hòn đảo, lô nhô trên mặt biển, nổi tiếng nhất là các hòn Lư Hương, Gà Chọi,
                        Cánh
                        Buồm, Mâm Xôi, đảo Ngọc Vừng, Ti Tốp, Tuần Châu. Hạ Long như bức tranh thủy mặc khổng
                        lồ,
                        tuyệt đẹp, xứng đáng là biểu tượng du lịch Việt Nam.
                    </div> -->

                    <div class="list-tours">
                        <div class="list-of-time">
                            <div class="tours">
                                @foreach($tours as $item)
                                <div class="tour">
                                    <div class="title">{{$item->tr_name}}</div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="tour-img">
                                                <img src="{{asset('/img/tourist-route/poster/'.$item->tr_poster)}}" alt="{{$item->tr_name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-md-8 left">
                                                    <div class="meta">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <span class="review-star" aria-valuetext="{{$item->avg}}">
                                                                </span> {{round($item->avg, 2)}}/5 trong {{$item->count}} đánh giá
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="info">
                                                        <div class="row">
                                                            <div class="col-sm-6">Khởi hành: {{\Carbon\Carbon::parse($item->tour_time_start)->format('d/m/Y')}}</div>
                                                            <div class="col-sm-6">Hoạt động: {{$item->cate_name}}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">Nơi khởi hành: {{$item->loca_name}}</div>
                                                            <div class="col-sm-6">Thời gian: {{$item->tr_time}} ngày
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="promotion">
                                                        <div class="row">
                                                            <div class="col-sm-6">Khuyến mãi: <span>Giảm {{$item->tour_promotion}}</span>
                                                            </div>
                                                            <div class="col-sm-6 slot">Số chổ còn nhận:
                                                                <span>{{$item->tr_max_slot - $item->tour_slot_book}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 right">
                                                    <div class="booking">
                                                        <div class="price">
                                                            {{number_format($item->tour_price)}} đ
                                                            <div>{{number_format($item->tr_original_price)}}</div>
                                                        </div>

                                                        <div class="btn-booking"><a href="{{asset('clients/tour/'.$item->tour_code)}}">CHI TIẾT</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-1">
                                    <div class="time">
                                        <div class="day">05</div>
                                        <div class="month-and-year">07/2019</div>
                                    </div>
                                </div>

                                <div class="col-lg-11">
                                    <div class="tours">
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/1.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/6.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/5.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-lg-1">
                                    <div class="time">
                                        <div class="day">05</div>
                                        <div class="month-and-year">07/2019</div>
                                    </div>
                                </div>

                                <div class="col-lg-11">
                                    <div class="tours">
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/1.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/6.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/5.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="time">
                                        <div class="day">05</div>
                                        <div class="month-and-year">07/2019</div>
                                    </div>
                                </div>

                                <div class="col-lg-11">
                                    <div class="tours">
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/1.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/6.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tour">
                                            <div class="title">Hà Nội - Lào Cai - Sapa - Fansipan - Chợ Phiên
                                                Bắc Hà - Yên Tử
                                                - Hạ Long</div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="tour-img">
                                                        <img src="../../imgs/5.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-8 left">
                                                            <div class="meta">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <span class="review-star" aria-valuetext="4">
                                                                        </span> 4/5 trong 369 đánh giá
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khởi hành: 05/07/2019
                                                                        | 07:00</div>
                                                                    <div class="col-sm-5">Hoạt động: Lặn</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-7">Nơi khởi hành: Hồ Chí
                                                                        Minh</div>
                                                                    <div class="col-sm-5">Thời gian: 4 ngày
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="promotion">
                                                                <div class="row">
                                                                    <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                                            2,000,000
                                                                            đ</span>
                                                                    </div>
                                                                    <div class="col-sm-5 slot">Số chổ còn nhận:
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 right">
                                                            <div class="booking">
                                                                <div class="price">
                                                                    11,990,000 đ
                                                                    <div>13,990,000</div>
                                                                </div>

                                                                <div class="btn-booking">CHI TIẾT</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="nav-page">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div id="search-filter">
                    <div class="title">
                        BỘ LỌC TÌM KIẾM
                    </div>

                    <div class="content">
                        <div class="item">
                            <div class="head">
                                GIÁ
                            </div>
                            <div class="body">
                                <div class="group">
                                    <!-- <select name="" id="">
                                        <option value="1">---</option>
                                        <option value="2">dưới 5 triệu</option>
                                        <option value="3">5 - 10 triệu</option>
                                        <option value="4">10 - 15 triệu</option>
                                        <option value="5">15 - 20 triệu</option>
                                        <option value="6">trên 20 triệu</option>
                                    </select> -->
                                    <div><input type="radio">Tăng dần</div>
                                    <div><input type="radio">Giảm dần</div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="head">
                                HOẠT ĐỘNG
                            </div>
                            <div class="body">
                                <div class="group">
                                    <select name="" id="">
                                        <option value="1">---</option>
                                        <option value="2">Leo núi</option>
                                        <option value="3">Lặn</option>
                                        <option value="4">Cưỡi voi</option>
                                        <option value="5">Nhảy dù</option>
                                        <option value="6">Khám phá hang động</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="head">ĐÁNH GIÁ</div>
                            <div class="body">
                                <div class="group">
                                    <div><input type="radio">Tăng dần</div>
                                    <div><input type="radio">Giảm dần</div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="head">TÌNH TRẠNG</div>
                            <div class="body">
                                <div class="group">
                                    <div><input type="radio">Còn chỗ</div>
                                    <div><input type="radio">Hết chổ</div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="btn-submit">
                                <button type="submit">LỌC</button>
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
<script src="/client/js/booking_tour.js" type="text/javascript"></script>
@stop