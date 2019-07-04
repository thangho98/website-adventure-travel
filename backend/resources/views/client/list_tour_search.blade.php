@if(!empty($list_tours))
@foreach ($list_tours as $item)
<div class="row tours-list">
    <div class="col-lg-1">
        <div class="time">
            @php
                $date = explode('-', $item['tour']->tour_time_start);
            @endphp
            <div class="day">{{$date[1]}}</div>
            <div class="month-and-year">{{$date[2]}}/{{$date[0]}}</div>
        </div>
    </div>
    <div class="col-lg-11">
        <div class="tours">
            <div class="tour">
                <div class="title">{{$item['tourist_routes']->tr_name}}</div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="tour-img">
                            <img src="/img/tourist-route/poster/{{$item['tourist_routes']->tr_poster}}" alt="poster">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-8 left">
                                <div class="meta">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span class="review-star"
                                                aria-valuetext="4">
                                            </span> {{$item['count_review']}}/5 trong {{$item['avg_review']}} đánh giá
                                        </div>
                                    </div>
                                </div>

                                <div class="info">
                                    <div class="row">
                                        <div class="col-sm-7">Khởi hành: {{date("d/m/Y", strtotime($item['tour']->tour_time_start))}}
                                            | 07:00</div>
                                        <div class="col-sm-5">Hoạt động: {{$item['category']->cate_name}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7">Nơi khởi hành: {{$item['location']->loca_name}} </div>
                                        <div class="col-sm-5">Thời gian: {{$item['tourist_routes']->tr_time}} ngày
                                        </div>
                                    </div>
                                </div>

                                <div class="promotion">
                                    <div class="row">
                                        @if (!empty($item['promotion']))
                                        <div class="col-sm-7">Khuyến mãi: <span>Giảm
                                                {{number_format($item['tourist_routes']->tr_original_price*$item['promotion']->prom_percent_promotion/100,0,',','.')}}
                                                đ</span>
                                        </div>
                                        @endif
                                        
                                        <div class="col-sm-5 slot">Số chổ còn nhận:
                                            <span>{{$item['tourist_routes']->tr_max_slot - $item['tour']->tour_slot_book}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 right">
                                <div class="booking">
                                    @if (!empty($item['promotion']))
                                        <div class="price">
                                                {{number_format($item['tour']->tour_price,0,',','.')}} đ
                                            <div>{{number_format($item['tourist_routes']->tr_original_price,0,',','.')}} đ</div>
                                        </div>
                                    @else
                                        <div class="price">
                                            {{number_format($item['tourist_routes']->tr_original_price,0,',','.')}} đ
                                        </div>
                                    @endif
                                    <a href="{{asset('clients/tour/'.$item['tour']->tour_code)}}" class="btn-booking">CHI TIẾT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

@endforeach
@else
    <h1 class="pt-5 text-center">KHÔNG TÌM THẤY TOUR NÀO SẴN CÓ</h1>
@endif