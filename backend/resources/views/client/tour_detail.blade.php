@extends('client.layouts.master')

@section('title', $tour_detail[0]->tr_name)

@section('content')
<div id="content">

    <!-- <div id="nav-links-content">
        <ul>
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Tour trong nước</a></li>
            <li><a href="#">Tour lặn</a></li>
            <li><a href="#">Du lịch Thái Lan Hè Bangkok - Pattaya tham quan thủy cung Pattaya từ Sài Gòn giá
                    tốt</a></li>
        </ul>
    </div> -->

    <div id="tour-wrapper">
        <div class="section wrapper">
            <div id="basic-info">
                <div class="head">
                    <h1>{{$tour_detail[0]->tr_name}}</h1>
                </div>
                <div id="info-content">
                    <div class="row">
                        <div id="tour-imgs" class="col-lg-7">
                            <div id="tour-imgs-carousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#tour-imgs-carousel" data-slide-to="0" class="active">
                                    </li>
                                    <li data-target="#tour-imgs-carousel" data-slide-to="1"></li>
                                    <li data-target="#tour-imgs-carousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{asset('../img/tourist-route/poster/'.$tour_detail[0]->tr_poster)}}">
                                    </div>
                                    @foreach($tour_images as $item)
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset('../img/tourist-route/'.$item->itr_name)}}">
                                    </div>
                                    @endforeach

                                </div>
                                <a class="carousel-control-prev" href="#tour-imgs-carousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#tour-imgs-carousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>

                        <div id="tour-content" class="col-lg-5">
                            <div class="info">
                                <div class="row">
                                    <div class="col-sm-3">Mã tour:</div>
                                    <div class="col-sm-4">{{$tour_detail[0]->tour_code}}</div>
                                    <div class="col-sm-4">Hoạt động: {{$tour_detail[0]->cate_name}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">Khởi hành:</div>
                                    <div class="col-sm-4">{{\Carbon\Carbon::parse($tour_detail[0]->tour_time_start)->format('d/m/Y')}}</div>
                                    <div class="col-sm-5"><i class="far fa-calendar-alt"></i> Ngày khác</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">Nơi khởi hành:</div>
                                    <div class="col-sm-4">{{$tour_detail[0]->loca_name}}</div>
                                    <div class="col-sm-5">Thời gian: {{$tour_detail[0]->tr_time}} ngày</div>
                                </div>
                            </div>

                            <div class="meta">
                                <div class="row">
                                    <div class="col-sm-12"><span class="review-star" aria-valuetext="{{round($review_score['score'], 0)}}"></span>
                                    {{round($review_score['score'], 2)}}/5 trong {{$review_score['count_comments']}} đánh giá
                                    </div>
                                </div>
                            </div>

                            <div class="promotion">
                                <div class="row">
                                    <div class="col-sm-12">Khuyến mãi:
                                        <span>
                                            @if($tour_detail[0]->tour_promotion == 0)
                                                Không có
                                            @else
                                            {{$tour_detail[0]->prom_name}} GIẢM {{$tour_detail[0]->prom_percent_promotion}}% giá tour
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="booking">
                                <div class="row">
                                    <div class="price-slot col-sm-7">
                                        <div class="price"><span>{{number_format($tour_detail[0]->tr_original_price,0,',','.')}} đ</span> {{number_format($tour_detail[0]->tour_price,0,',','.')}} đ</div>
                                        <div class="slot">Số chổ còn nhận: <span>{{$tour_detail[0]->tr_max_slot - $tour_detail[0]->tour_slot_book}}</span></div>
                                    </div>
                                    @if( $tour_detail[0]->tr_max_slot != $tour_detail[0]->tour_slot_book)
                                        <div class="btn-booking col-sm-5"><a href="{{asset('clients/booking/'.$code)}}">ĐẶT NGAY</a></div>
                                    @else
                                       <div class="btn-booking col-sm-5"><a>ĐẶT NGAY</a></div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content-wrapper" class="section">
            <nav class="navbar navbar-expand-sm sticky-top wrapper">
                <ul class="left navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{asset('clients/tour/'.$code.'/#gioi-thieu')}}">GIỚI THIỆU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{asset('clients/tour/'.$code.'/#lich-trinh')}}">LỊCH TRÌNH</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{asset('clients/tour/'.$code.'/#luu-y')}}">LƯU Ý</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{asset('clients/tour/'.$code.'/#ngay-khac')}}">NGÀY KHÁC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{asset('clients/tour/'.$code.'/#binh-luan')}}">BÌNH LUẬN</a>
                    </li>
                </ul>

                <ul class="right navbar-nav">
                    <li class="nav-item">
                    @if( $tour_detail[0]->tr_max_slot != $tour_detail[0]->tour_slot_book)
                        <a class="booking nav-link" href="{{asset('clients/booking/'.$code)}}">ĐẶT NGAY</a>
                    @else
                    <a class="booking nav-link">ĐẶT NGAY</a>
                    @endif  
                    </li>
                </ul>
            </nav>
            <div class="row wrapper">
                <div class="content-left col-lg-9">
                    <div id="gioi-thieu" class="content-section">
                        <div class="title">GIỚI THIỆU</div>
                        <div class="content">
                            <div class="des">
                                Điểm nhấn: - Hành trình khám phá Singapore mới lạ dành cho cả gia đình trong mùa
                                hè
                                này. - Tham quan Trung tâm Khoa học (Science Centre) tìm hiểu về khoa học, văn
                                hóa,
                                lịch sử và nền giáo dục Singapore - Xem phim khoa học tại Rạp Omni với mái vòm
                                8K
                                digital duy nhất tại Singapore - Butterflies Up-Close – trải nghiệm cảm giác
                                được
                                vây quanh bởi những chú bướm tại ngôi nhà lồng nuôi bướm đầu tiên tại Singapore.
                                -
                                Ghé thăm Vườn thú Singapore Zoo được xem là một trong những vườn thú hoang dã
                                đẹp
                                nhất trên thế giới với hơn 2.300 cá thể thuộc 300 loài - River Safari – công
                                viên
                                hoang dã theo chủ đề sông nước đầu tiên và duy nhất Châu Á - Trung tâm triển lãm
                                Bee
                                Cheng Hiang Grillery – là trung tâm triển lãm món thịt nướng nổi tiếng và đặc
                                trưng
                                của Singapore tìm hiểu quay trình chế biến món ăn độc đáo này, thưởng thức món
                                bánh
                                nướng Salted Caramel BBQ Floss Cake độc đáo
                            </div>

                            <div class="location">
                                <div class="title-2">Nơi đến</div>
                                <div id="carousel-location" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="list-imgs">
                                                @foreach($destinations as $item)
                                                <a href="#" class="item-img">
                                                    <img src="{{asset('../img/location/'.$item->loca_poster)}}">
                                                    <div class="tit">{{$item->loca_name}}</div>
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <a class="carousel-control-prev" href="#carousel-location" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-location" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a> -->
                                </div>
                            </div>

                            <!-- <div class="map">
                                <div class="title-2">Bản đồ</div>
                                <div id="map"></div>
                            </div> -->

                        </div>
                    </div>
                    <div id="lich-trinh" class="content-section">
                        <div class="title">LỊCH TRÌNH</div>
                        <div class="content">
                            <div class="list-day">
                                <div class="day">
                                    <div class="tit-day">
                                        <span>NGÀY {{$tour_schedules[0]->trd_date}} |</span>
                                    </div>
                                    <div class="cont-day" style="display: block;">
                                        {{$tour_schedules[0]->trd_description}}
                                    </div>
                                </div>
                                @for($i = 1; $i < count($tour_schedules); $i++) <div class="day">
                                    <div class="tit-day">
                                        <span>NGÀY {{$tour_schedules[$i]->trd_date}} |</span>
                                    </div>
                                    <div class="cont-day">
                                        {{$tour_schedules[$i]->trd_description}}
                                    </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div id="luu-y" class="content-section">
                    <div class="title">LƯU Ý</div>
                    <div class="content"></div>
                </div>
                <div id="ngay-khac" class="content-section">
                    <div class="title">NGÀY KHÁC</div>
                    <div class="content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Ngày khởi hành</th>
                                    <th scope="col">Khuyến mãi</th>
                                    <th scope="col">Giá từ</th>
                                    <th scope="col">Số chổ</th>
                                    <th scope="col">Book tour</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($orther_days); $i++) <tr>
                                    <th scope="row">{{$i+1}}</th>
                                    <td>{{$orther_days[$i]->tour_time_start}}</td>
                                    <td>
                                        @if($orther_days[$i]->tour_promotion == 0)
                                        Không có
                                        @else
                                            GIẢM {{$orther_days[$i]->prom_percent_promotion}}%
                                        @endif
                                    </td>
                                    <td>{{number_format($orther_days[$i]->tour_price,0,',','.')}} đ</td>
                                    <td>Còn {{$orther_days[$i]->tr_max_slot - $orther_days[$i]->tour_slot_book}} chổ</td>
                                    <td><a href="{{asset('clients/booking/'.$orther_days[$i]->tour_code)}}"><button class="btn btn-danger">Book</button></a></td>
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="binh-luan" class="content-section">
                    <div class="title">BÌNH LUẬN</div>
                    <div class="content">
                        <div class="reviews-box">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="review-box-score">
                                        <div class="review-score">{{round($review_score['score'], 2)}}<span class="per-total">/5</span>
                                        </div>
                                        <div class="review-score-text">{{$review_score['score_text']}}</div>
                                        <div class="review-score-base">Dựa trên {{$review_score['count_comments']}} reviews</div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="review-sumary">
                                        @for($i = 5; $i >=1; $i--)
                                        <div class="item">
                                            <div class="label">{{$review_score['review_chart'][$i]['text']}}</div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{$review_score['review_chart'][$i]['percent']}}%" aria-valuenow="{{$review_score['review_chart'][$i]['percent']}}" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="count-reviews">{{$review_score['review_chart'][$i]['count']}}</div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="reviews-list">
                            @foreach($comments as $item)
                            <div class="comment-item">
                                <div class="comment-item-head">
                                    <div class="media-left">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">{{$item->user_name}}</div>
                                        <div class="date">{{$item->revi_time}}</div>
                                    </div>
                                    <div class="media-right">
                                        <div class="review-star" aria-valuetext="{{$item->revi_star}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-item-body">
                                    <div class="content">
                                        {{$item->revi_content}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="write-review">
                            <div class="heading">Thêm nhận xét</div>
                            <form action="{{asset('clients/tour/comment/'.$code)}}" method="post">
                                <div class="form-comment-wrapper">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <!-- @if(Auth::guard('client')->check())
                                            <input type="text" name="comment_name" placeholder="Nhập tên của bạn" value="{{Auth::guard('client')->user()->user_name}}">
                                            <input type="email" name="comment_emali" placeholder="Nhập email" value="{{Auth::guard('client')->user()->email}}">
                                            @else
                                            <input type="text" name="comment_name" placeholder="Nhập tên của bạn">
                                            <input type="email" name="comment_emali" placeholder="Nhập email">
                                            @endif -->
                                            <div class="stars">
                                                <span>Chọn số sao </span>
                                                <span id="input-stars" class="review-star" aria-valuetext="1">
                                                </span>
                                                <input type="hidden" id="id-score" name="score" value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea name="comment_content" rows="3" placeholder="Nội dung"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-comment">Nhận xét</button>
                                </div>
                                {{csrf_field()}}
                            </form>
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
</div>
@stop

@section('script')
<script src="/client/js/library.js" type="text/javascript"></script>
<script src="/client/js/tour_detail.js" type="text/javascript"></script>
<!-- google map -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2S_ftQJDQw1DyaYKIrr-34Hx8tUER0Yc&callback=initMap">
</script> -->
@stop