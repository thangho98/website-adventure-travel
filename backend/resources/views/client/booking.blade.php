@extends('client.layouts.master')

@section('title', 'Booking tour')

@section('content')
<div id="content">
    <div class="wrapper">
        <div class="row">
            <div id="booking-tour" class="tours col-lg-9">
                <div class="tours-title">
                    <h2>ĐẶT TOUR</h2>
                </div>
                <div class="list-tours">
                    <div class="tours">
                        <div class="tour">
                            <div class="title">{{$tour_detail->tr_name}}</div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="tour-img">
                                        <img src="/client/imgs/1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-8 left">
                                            <div class="meta">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <span class="review-star" aria-valuetext="4">
                                                        </span>{{round($review_score['score'], 2)}}/5 trong {{$review_score['count_comments']}} đánh giá
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="info">
                                                <div class="row">
                                                    <div class="col-sm-6">Khởi hành: {{\Carbon\Carbon::parse($tour_detail->tour_time_start)->format('d/m/Y')}}</div>
                                                    <div class="col-sm-6">Hoạt động: {{$tour_detail->cate_name}}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">Nơi khởi hành: {{$tour_detail->loca_name}}</div>
                                                    <div class="col-sm-6">Thời gian: {{$tour_detail->tr_time}} ngày
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="promotion">
                                                <div class="row">
                                                    <div class="col-sm-6">Khuyến mãi:
                                                        <span>
                                                            @if($tour_detail->tour_promotion == 0)
                                                                Không có
                                                            @else
                                                                GIẢM {{$tour_detail->prom_percent_promotion}}%
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-6 slot">Số chổ còn nhận:
                                                        <span id="slot-free">{{$tour_detail->tr_max_slot - $tour_detail->tour_slot_book}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 right">
                                            <div class="booking">
                                                <div class="price">
                                                {{number_format($tour_detail->tour_price)}} đ
                                                    <div>{{number_format($tour_detail->tr_original_price)}} đ</div>
                                                </div>

                                                <div class="btn-booking"><a href="{{asset('clients/tour/'.$tour_detail->tour_code)}}">CHI TIẾT</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{asset('clients/booking/book/'.$tour_detail->tour_code)}}" method="post">
                        <div class="row">

                            <div class="col-lg-6">
                                <div id="user-infomation">
                                    <div class="title">
                                        Thông tin của bạn
                                    </div>
                                    <div class="content">
                                        <div class="item">
                                            <label for="user_info_name">Họ và tên</label>
                                            <input type="text" name="name" placeholder="Nhập tên" value="{{$user->user_name}}">
                                        </div>
                                        <div class="item">
                                            <label for="user_info_name">Ngày sinh</label>
                                            <input type="date" name="birthday" value="{{$user->user_birthday}}" style="width: 175.2px;">
                                        </div>
                                        <div class="item">
                                            <label for="user_info_name">Email</label>
                                            <input type="text" name="email" placeholder="Nhập email" value="{{$user->email}}">
                                        </div>
                                        <div class="item">
                                            <label for="user_info_name">Điện thoại</label>
                                            <input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{$user->user_phone}}">
                                        </div>
                                        <div class="item">
                                            <label for="user_info_name">Địa chỉ</label>
                                            <input type="text" name="address" placeholder="Nhập địa chỉ" value="{{$user->user_address}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div id="amount-people">
                                    <div class="title">
                                        Số lượng hành khách
                                    </div>
                                    <div class="content">
                                        <div class="item group-input">
                                            <label for="user_info_name">Trên 12 tuổi</label>
                                            <div class="group-input-count">
                                                <button type="button" class="btn-minus"> - </button>
                                                <input name="num_adult" class="input-count" type="text" value="1">
                                                <button type="button" class="btn-add">+</button>
                                            </div>

                                        </div>
                                        <div class="item group-input">
                                            <label for="user_info_name">Dưới 12 tuổi</label>
                                            <div class="group-input-count">
                                                <button type="button" class="btn-minus">-</button>
                                                <input name="num_child" class="input-count" type="text" value="0">
                                                <button type="button" class="btn-add">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div id="price-sum">TỔNG CỘNG: <span>20,500,000 đ</span></div> -->
                                <button style="margin-top: 55px" id="btn-book" type="submit">BOOK <i class="fab fa-cc-paypal"></i></button>
                            </div>
                        </div>
                        {{csrf_field()}}
                    </form>
                </div>
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
@stop

@section('script')
<script src="/client/js/library.js" type="text/javascript"></script>
<script src="/client/js/booking_tour.js" type="text/javascript"></script>
@stop