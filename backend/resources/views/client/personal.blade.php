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
                <div class="tours-list">
                    <div id="user-infomation">
                        <div class="row">
                            <div class="col-md-5">
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
                                            <input type="date" name="birthday" value="{{$user->user_bitrhday}}">
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

                            <div class="col-lg-7"></div>
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
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã tour</th>
                                        <th scope="col">Tên tour</th>
                                        <th scope="col">Ngày khởi hành</th>
                                        <th scope="col">Tình trạng</th>
                                        <th scope="col">Công cụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>05/07/2019</td>
                                        <td>Không có</td>
                                        <td>11,990,000 đ</td>
                                        <td>Đã đặt</td>
                                        <td><button class="btn btn-info">Chi tiết</button><button class="btn btn-danger">Hủy</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>10/07/2019</td>
                                        <td>Đã đi</td>
                                        <td>11,990,000 đ</td>
                                        <td>Đã đi</td>
                                        <td><button class="btn btn-info">Chi tiết</button><button class="btn btn-danger" disabled>Hủy</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>15/07/2019</td>
                                        <td>Giảm 2,000,000 đ</td>
                                        <td>11,990,000 đ</td>
                                        <td>Đã hủy</td>
                                        <td><button class="btn btn-info">Chi tiết</button><button class="btn btn-danger" disabled>Hủy</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="tour-favorite" class="tour-table">
                        <div class="title">
                            Tour yêu thích
                        </div>
                        <div class="content">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã tour</th>
                                        <th scope="col">Tên tour</th>
                                        <th scope="col">Ngày khởi hành</th>
                                        <th scope="col">Tình trạng</th>
                                        <th scope="col">Công cụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>05/07/2019</td>
                                        <td>Không có</td>
                                        <td>11,990,000 đ</td>
                                        <td>Đã đặt</td>
                                        <td><button class="btn btn-info">Chi tiết</button><button class="btn btn-danger">Book</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>10/07/2019</td>
                                        <td>Đã đi</td>
                                        <td>11,990,000 đ</td>
                                        <td>Đã đi</td>
                                        <td><button class="btn btn-info">Chi tiết</button><button class="btn btn-danger">Book</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>15/07/2019</td>
                                        <td>Giảm 2,000,000 đ</td>
                                        <td>11,990,000 đ</td>
                                        <td>Đã hủy</td>
                                        <td><button class="btn btn-info">Chi tiết</button><button class="btn btn-danger">Book</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-right col-lg-3">
                <div id="suggestions">
                    <div class="title">CÓ THỂ BẠN SẼ THÍCH</div>
                    <div class="tours">
                        <div class="tours-list">
                            <div class="row">
                                <div class="tour-item col-lg-12 col-md-6">
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
                                <div class="tour-item col-lg-12 col-md-6">
                                    <div class="tour-item-wrapper">
                                        <div class="tour-header">
                                            <a href=""><img class="ani-img-zoom" src="/client/imgs/5.jpg" alt=""></a>
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
                                <div class="tour-item col-lg-12 col-md-6">
                                    <div class="tour-item-wrapper">
                                        <div class="tour-header">
                                            <a href=""><img class="ani-img-zoom" src="/client/imgs/6.jpg" alt=""></a>
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
                                <div class="tour-item col-lg-12 col-md-6">
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