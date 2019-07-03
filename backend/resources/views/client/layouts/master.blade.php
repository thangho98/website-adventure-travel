<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{asset('client')}}/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="imgs/logo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--Font Awesome's CDN-->
    <script src="https://kit.fontawesome.com/810701e39f.js"></script>
    <!--Font Roboto-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!--Home CSS-->
    <link rel="stylesheet" href="css/home.css">
</head>

<body>

    <div id="background-blur"></div>
    <div id="signin-form" class="user-form">
        <div class="form-wrapper">
            <div class="btn-close"><i class="fas fa-times"></i></div>
            <div class="title">ĐĂNG NHẬP</div>
            <form action="{{route('loginClient')}}" method="post">
                <div class="input">
                    <label for="sigin-email">Email</label>
                    <input type="text" id="signin-email" name="email" placeholder="Nhập email">
                    <label for="sigin-password">Mật khẩu</label>
                    <input type="password" id="signin-password" name="password" placeholder="Nhập password">
                    <div>Bạn chưa có tài khoản? <span class="signup-now">Đăng ký ngay</span></div>
                    <div>Quên mật khẩu? <span class="reset-password">Lấy lại mật khẩu</span></div>
                    <button type="submit" class="btn-submit">Đăng nhập</button>
                </div>
                {{csrf_field()}}
            </form>

        </div>

    </div>
    <div id="signup-form" class="user-form">
        <div class="form-wrapper">
            <div class="btn-close"><i class="fas fa-times"></i></div>
            <div class="title">ĐĂNG KÝ</div>
            <form action="{{route('registerClient')}}" method="post">
                <div class="input">
                    <label for="signup-name">Họ và tên</label>
                    <input type="text" id="signup-name" name="name" placeholder="Nhập tên của bạn">
                    @if($errors->has('name'))
                    @foreach($errors->get('name') as $error)
                    <div class="text-error">{{$error}}</div>
                    @endforeach
                    @endif
                    <label for="signup-email">Email</label>
                    <input type="text" id="signup-email" name="email" placeholder="Nhập email của bạn">
                    @if($errors->has('email'))
                    @foreach($errors->get('email') as $error)
                    <div class="text-error">{{$error}}</div>
                    @endforeach
                    @endif
                    <label for="signup-password">Mật khẩu</label>
                    <input type="password" id="signup-password" name="password" placeholder="Nhập password">
                    @if($errors->has('password'))
                    @foreach($errors->get('password') as $error)
                    <div class="text-error">{{$error}}</div>
                    @endforeach
                    @endif
                    <label for="signup-re-password">Nhập lại mật khẩu</label>
                    <input type="password" id="signup-re-password" name="re_password" placeholder="Nhập lại password">
                    @if($errors->has('re_password'))
                    @foreach($errors->get('re_password') as $error)
                    <div class="text-error">{{$error}}</div>
                    @endforeach
                    @endif
                    <button type="submit" class="btn-submit">Đăng ký</button>
                </div>
                {{csrf_field()}}
            </form>

        </div>

    </div>
    <div id="full-container">

        <header id="header">
            <nav>
                <div id="nav-top">
                    <div class="container">
                        <div id="hotline">
                            <i class="fas fa-phone-square-alt"></i>Hotline hỗ trợ: <span id="sdt">0968 775
                                364</span><span id="cuoc"> 1000đ/phút</span>
                        </div>

                        @if(Route::has('login'))
                        <div id="user">
                            @if(Auth::guard('client')->check())
                            <div id="user-menu">
                                <div id="welcome-user"><span>Xin chào {{Auth::guard('client')->user()->user_name}}</span><i class="fas fa-chevron-circle-down"></i></div>
                                <div id="menu-user">
                                    <ul>
                                        <li><a href="{{asset(route('personal'))}}">Trang cá nhân</a></li>
                                        <li><a href="#">Lịch sử đặt tour</a></li>
                                        <li><a href="#">Tours yêu thích</a></li>
                                        <form action="{{route('logoutClient')}}" method="post">
                                            <li id="logout"><button type="submit">Đăng xuất</button></li>
                                            {{csrf_field()}}
                                        </form>
                                    </ul>
                                </div>
                            </div>
                            @else
                            <div id="signin" class="user-item">Đăng nhập</div>
                            <div id="signup" class="user-item">Đăng ký</div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <div id="nav-bot" class="navbar navbar-expand-lg">
                    <div class="container">
                        <div id="logo-header" class="navbar-brand">
                            <a href="{{asset(route('homeClient'))}}"><img src="imgs/Logo2.png" alt="Team13.com"></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-links" aria-controls="nav-links" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div id="nav-links" class="collapse navbar-collapse">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="tour-trong-nuoc.html">TOUR TRONG NƯỚC</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="tour-nuoc-ngoai.html">TOUR NƯỚC NGOÀI</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="loai-hinh-mao-hiem.html">LOẠI HÌNH MẠO
                                        HIỂM</a></li>
                                <li class="nav-item"><a class="nav-link" href="tin-tuc.html">TIN TỨC</a></li>
                                <li class="nav-item"><a class="nav-link" href="gioi-thieu.html">GIỚI THIỆU</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div id="slideshow">
                <div id="carousel-slideshow" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="imgs/slide1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="imgs/slide2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="imgs/slide3.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-slideshow" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-slideshow" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div id="search">
                <div id="search-btn" class="wrapper">
                    <div class="row">

                        <div class="col-lg-4">
                            <div id="search-trong-nuoc" class="search-item">
                                <i class="fas fa-car"></i></i>
                                <div class="search-title ">
                                    TÌM TOUR <span>TRONG NƯỚC</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div id="search-nuoc-ngoai" class="search-item">
                                <i class="fas fa-plane"></i></i>
                                <div class="search-title ">
                                    TÌM TOUR <span>NƯỚC NGOÀI</span>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div id="search-tour-da-dat" class="search-item">
                                <i class="fas fa-search-location"></i>
                                <div class="search-title ">
                                    TÌM TOUR <span>ĐÃ ĐẶT</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="wrapper">
                    <div id="form-search-trong-nuoc" class="search-form">
                        <form action="">
                            <div class="row">
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NƠI KHỞI HÀNH</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NƠI ĐẾN</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NGÀY KHỞI HÀNH</div>
                                    <input type="date">
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">HOẠT ĐỘNG</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">GIÁ</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <button type="submit">TÌM KIẾM</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="form-search-nuoc-ngoai" class="search-form">
                        <form action="">
                            <div class="row">
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NƠI KHỞI HÀNH</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NƠI ĐẾN</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NGÀY KHỞI HÀNH</div>
                                    <input type="date">
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">HOẠT ĐỘNG</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">GIÁ</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <button type="submit">TÌM KIẾM</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="form-search-tour-da-dat" class="search-form">
                        <form action="">
                            <div class="row">
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NƠI KHỞI HÀNH</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NƠI ĐẾN</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">NGÀY KHỞI HÀNH</div>
                                    <input type="date">
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">HOẠT ĐỘNG</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <div class="title">GIÁ</div>
                                    <select name="" id="">
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà nẵng</option>
                                    </select>
                                </div>
                                <div class="item col-lg-2 col-md-4">
                                    <button type="submit">TÌM KIẾM</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>



            </div>

        </header>

        @yield('content');

    </div>

    <div id="introduction">
        <div class="tours-title">
            <h2>VÌ SAO CHỌN TEAM13.COM</h2>
        </div>
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="stt">1</div>
                        <div class="content">
                            <div class="title">MẠNG BÁN TOUR</div>
                            <div class="des">Số 1 tại Việt Nam, ứng dụng công nghệ mới nhất</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="stt">2</div>
                        <div class="content">
                            <div class="title">THANH TOÁN</div>
                            <div class="des">An toàn và linh hoạt, liên kết với các tổ chức tài chính</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="stt">3</div>
                        <div class="content">
                            <div class="title">GIÁ CẢ</div>
                            <div class="des">Luôn có mức giá tốt nhất, bảo đảm giá tốt</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="stt">4</div>
                        <div class="content">
                            <div class="title">SẢN PHẨM</div>
                            <div class="des">Đa dạng, chất lượng, đạt chất lượng tốt nhất</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-0"></div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="stt">5</div>
                        <div class="content">
                            <div class="title">ĐẶT TOUR</div>
                            <div class="des">Dễ dàng và nhanh chóng, đặt tour chỉ với 3 bước</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="stt">6</div>
                        <div class="content">
                            <div class="title">HỖ TRỢ</div>
                            <div class="des">24/7, Hotline và hỗ trợ trực tuyến</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="reviews">
        <div class="wrapper">
            <div class="row">
                <div class="head col-md-3">
                    <h2>Ý KIẾN KHÁCH HÀNG</h2>
                </div>
                <div class="body col-md-9">
                    <div id="carousel-reviews" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="title">
                                    CHIA SẺ CỦA KHÁCH HÀNG NGUYỄN ĐẶNG HIỀN , TOUR NHẬT BẢN NGÀY 16/03/2019
                                </div>
                                <div class="date-time">
                                    <i class="fas fa-calendar-alt"></i> 01/04/19 11:24:10
                                </div>
                                <p>Tôi khá hài lòng về chuyến đi Nhật Bản ngày 16/03/2019. Điều ấn tượng nhất về
                                    chuyến
                                    đi là được nhìn thấy về đất nước và con người Nhật Bản. Đặc biệt hơn cả là
                                    sự
                                    chia
                                    sẻ nhiệt tình và sự quan tâm chu đáo của HDV chị Lư Ngọc Liên và HDV địa
                                    phương
                                    cô
                                    JJ. Tôi thực sự rất cảm kích bởi họ đã có “tuổi” nhưng lúc nào cũng giữ được
                                    sự
                                    lạc
                                    quan, vui vẻ và một nguồn năng lượng tuyệt vời.</p>
                            </div>
                            <div class="carousel-item">
                                <div class="title">
                                    CHIA SẺ CỦA KHÁCH HÀNG NGUYỄN ĐẶNG HIỀN , TOUR NHẬT BẢN NGÀY 16/03/2019
                                </div>
                                <div class="date-time">
                                    <i class="fas fa-calendar-alt"></i> 01/04/19 11:24:10
                                </div>
                                <p>Tôi khá hài lòng về chuyến đi Nhật Bản ngày 16/03/2019. Điều ấn tượng nhất về
                                    chuyến
                                    đi là được nhìn thấy về đất nước và con người Nhật Bản. Đặc biệt hơn cả là
                                    sự
                                    chia
                                    sẻ nhiệt tình và sự quan tâm chu đáo của HDV chị Lư Ngọc Liên và HDV địa
                                    phương
                                    cô
                                    JJ. Tôi thực sự rất cảm kích bởi họ đã có “tuổi” nhưng lúc nào cũng giữ được
                                    sự
                                    lạc
                                    quan, vui vẻ và một nguồn năng lượng tuyệt vời.</p>
                            </div>
                            <div class="carousel-item">
                                <div class="title">
                                    CHIA SẺ CỦA KHÁCH HÀNG NGUYỄN ĐẶNG HIỀN , TOUR NHẬT BẢN NGÀY 16/03/2019
                                </div>
                                <div class="date-time">
                                    <i class="fas fa-calendar-alt"></i> 01/04/19 11:24:10
                                </div>
                                <p>Tôi khá hài lòng về chuyến đi Nhật Bản ngày 16/03/2019. Điều ấn tượng nhất về
                                    chuyến
                                    đi là được nhìn thấy về đất nước và con người Nhật Bản. Đặc biệt hơn cả là
                                    sự
                                    chia
                                    sẻ nhiệt tình và sự quan tâm chu đáo của HDV chị Lư Ngọc Liên và HDV địa
                                    phương
                                    cô
                                    JJ. Tôi thực sự rất cảm kích bởi họ đã có “tuổi” nhưng lúc nào cũng giữ được
                                    sự
                                    lạc
                                    quan, vui vẻ và một nguồn năng lượng tuyệt vời.</p>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-reviews" role="button" data-slide="prev">
                            <i class="fas fa-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-reviews" role="button" data-slide="next">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-4">
                    <div class="title">MẠNG BÁN TOUUR DU LỊCH MẠO HIỂM Team13.COM</div>
                    <div class="content">
                        <p><strong>Đại diện:</strong> Ông Trần Văn Long - Chủ tịch HĐQT kiêm Tổng giám đốc</p>
                        <p><strong>Trụ sở chính:</strong> 95B-97-99 Trần Hưng Đạo, Quận 1, TP. Hồ Chí Minh.</p>
                        <p><strong>Chi nhánh Hà Nội:</strong> 66 Trần Hưng Đạo, Quận Hoàn Kiếm, Hà Nội</p>
                        <p><strong>Điện thoại:</strong> 0984567669 | <strong>Hotline:</strong> 0968775364</p>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="title">Góc khách hàng</div>
                    <div class="content">
                        <div><a href="#">Chính sách đặt tour</a></div>
                        <div><a href="">Chính sách bảo mật</a></div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="title">Đăng ký nhận thông tin khuyến mãi</div>
                    <div class="content">
                        <p>Nhập email để có cơ hội giảm 50% cho chuyến đi tiếp theo của Quý khách</p>
                        <div class="form">
                            <form action="">
                                <input type="text" placeholder="Email của bạn">
                                <button type="submit"><i class="fas fa-envelope"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="title">Kết nối với chúng tôi</div>
                    <div class="content">
                        <div class="links">
                            <a href="#" class="fb"><i class="fab fa-facebook-square"></i></a>
                            <a href="#" class="gg"><i class="fab fa-google-plus-square"></i></a>
                            <a href="#" class="tw"><i class="fab fa-twitter-square"></i></a>
                            <a href="#" class="yt"><i class="fab fa-youtube-square"></i></a>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    <div class="title">Chấp nhận thanh toán</div>
                    <div class="content">
                        <img src="imgs/pay.png" alt="Chấp nhận thanh toán">
                    </div>
                    <div class="title">Chứng nhận</div>
                    <div class="content">
                        <p><img src="imgs/dmca.png" alt="DMCA"></p>
                        <p><img src="imgs/congthuong.png" alt="Công thương"></p>

                    </div>


                </div>
            </div>
        </div>
    </footer>

    <div id="copyright">
        <div class="wrapper">
            <p>Copyright © 2019 Team13.com. Bảo lưu mọi quyền. Ghi rõ nguồn "www.Team13.com" khi sử dụng
                lại thông tin từ website này</p>
            <p>Số GPKD: 0300465937 do Sở Kế Hoạch và Đầu Tư Thành Phố Hồ Chí Minh cấp ngày 27/09/2010</p>
            <p>Giấy phép số: 239/GP-TTĐT do Cục Quản Lý Phát Thanh, Truyền Hình và Thông Tin Điện Tử cấp ngày
                31/12/2008 </p>
        </div>
    </div>



    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- my js-->
    @yield('script')
</body>

</html>