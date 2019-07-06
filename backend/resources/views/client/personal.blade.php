@extends('client.layouts.master')

@section('title', 'Trang cá nhân')

@section('content')
<div id="content">
    <div class="wrapper">
        <div class="row">
            <div id="personal" class="tours col-lg-9">
                <div class="tours-title">
                    <h2>TRANG CÁ NHÂN</h2>
                </div>
               
                    <div id="user-information">
                    <div class="list-tours">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="title">
                                    Thông tin của bạn
                                </div>
                                <div class="content">
                                    <form action="{{route('personalUpdateProfile')}}" method="post">
                                        <div class="item">
                                            <label for="user_info_name">Họ và tên</label>
                                            <input type="text" name="name" placeholder="Nhập tên" value="{{$user->user_name}}">
                                        </div>
                                        <div class="item">
                                            <label for="user_info_name">Ngày sinh</label>
                                            <input type="date" name="birthday" value="{{$user->user_birthday}}">
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
                                        <div class="item">
                                            <button type="submit">Cập nhật</button>
                                        </div>
                                        {{csrf_field()}}
                                    </form>

                                </div>
                            </div>

                            <div class="col-lg-6"></div>
                        </div>

                    </div>

                    <div id="tour-history" class="tour-table">
                        <div class="title">
                            Tour đã đặt
                        </div>
                        <div class="content">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã tour</th>
                                        <th scope="col">Tên tour</th>
                                        <th scope="col">Ngày khởi hành</th>
                                        <th scope="col">Ngày đặt</th>
                                        <th scope="col">Tình trạng</th>
                                        <th scope="col">Công cụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($booked as $item)
                                    <tr>
                                        <td>{{$item->tour_code}}</td>
                                        <td>{{$item->tr_name}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->tour_time_start)->format('d/m/Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->bt_date)->format('d/m/Y')}}</td>
                                        <td>
                                            @if($item->bt_status == 0)
                                                Chưa thanh toán
                                            @elseif($item->bt_status == 1)
                                                Đã thanh toán
                                            @endif
                                        </td>
                                        <td><button class="btn btn-info"><a href="{{asset('clients/tour/'.$item->tour_code)}}" style="color: #fff; text-decoration: none;">Chi tiết</a></button>
                                        <!-- <button class="btn btn-danger">Hủy</button> -->
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

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
<script src="/client/js/home.js" type="text/javascript"></script>
@stop