@extends('client.layouts.master')

@section('title', 'Team13.com - Mạng bán tour du lịch mạo hiểm trực tuyến')
@section('css')
    <link rel="stylesheet" href="https://cdn.bootcss.com/simplePagination.js/1.6/simplePagination.min.css">
    <style>
        .simple-pagination ul {
            margin: 0 0 20px;
            padding: 0;
            list-style: none;
            text-align: center;
        }

        .simple-pagination li {
            display: inline-block;
            margin-right: 5px;
        }

        .simple-pagination li a,
        .simple-pagination li span {
            color: #666;
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #EEE;
            background-color: #FFF;
            box-shadow: 0px 0px 10px 0px #EEE;
        }

        .simple-pagination .current {
            color: #FFF;
            background-color: #FF7182;
            border-color: #FF7182;
        }

        .simple-pagination .prev.current,
        .simple-pagination .next.current {
            background: #e04e60;
        }
    </style>
@endsection
@section('content')
<div id="content">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-9">
                <div id="search-results">
                    <div class="title">
                        @if ($destination != 'all' && $starting_gate != 'all')
                        <h1>DANH SÁCH TOUR DU LỊCH {{mb_strtoupper($destination->loca_name, "UTF-8")}} KHỞI HÀNH TỪ {{mb_strtoupper($starting_gate->loca_name, "UTF-8")}}</h1>
                        @elseif($destination != 'all' && $starting_gate == 'all')
                        <h1>DANH SÁCH TOUR DU LỊCH {{mb_strtoupper($destination->loca_name, "UTF-8")}}</h1>
                        @elseif($destination == 'all' && $starting_gate != 'all')
                        <h1>DANH SÁCH TOUR DU LỊCH KHỞI HÀNH TỪ {{ mb_strtoupper($starting_gate->loca_name, "UTF-8")}}</h1>
                        @endif
                        
                    </div>

                    <div class="list-tours">
                        <div id="content-tours" class="list-of-time">
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
                       
                        </div>
                       
                    </div>
                    @if(!empty($list_tours))
                    <div id="pagination" class="nav-page">
                        <div id="pagination-container"></div>
                    </div>
                    @endif
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
                                    
                                    <div><input name="price_order" value="asc" type="radio">Tăng dần</div>
                                    <div><input name="price_order" value="desc" type="radio">Giảm dần</div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="item">
                            <div class="head">ĐÁNH GIÁ</div>
                            <div class="body">
                                <div class="group">
                                    <div><input input name="revi_order" value="asc" type="radio">Tăng dần</div>
                                    <div><input input name="revi_order" value="desc" type="radio">Giảm dần</div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="item">
                            <div class="head">TÌNH TRẠNG</div>
                            <div class="body">
                                <div class="group">
                                    <div><input name="status_order" value="still" type="radio">Còn chỗ</div>
                                    <div><input name="status_order" value="over" type="radio">Hết chổ</div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="btn-submit">
                                <button type="button" onclick="onChangeHandle()">LỌC</button>
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
<script src="{{asset('/')}}client/js/library.js"></script>
<script src="{{asset('/')}}client/js/search.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
    $(document).ready(function() {
        paginate();
    });
    function paginate () { 
        var items = $(".list-of-time .tours-list");
       
        var numItems = items.length;

        $('#pagination').empty();
        if(numItems == 0){
            return;
        }
        else{
            $('#pagination').append('<div id="pagination-container"></div>');
        }

        var perPage = 10;

        items.slice(perPage).hide();

        $('#pagination-container').pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function (pageNumber) {
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;
                items.hide().slice(showFrom, showTo).show();
            }
        });
    }
    function onChangeHandle(){

        var price_order = $("input:radio[name ='price_order']:checked").val();
        var status_order = $("input:radio[name ='status_order']:checked").val();

        // URL có kèm tham số number
        var url = '{{asset('clients/search/ajax/')}}/';

        // Data lúc này cho bằng rỗng
        var data = {
            starting_gate: getAllUrlParams().starting_gate,
            destination: getAllUrlParams().destination,
            departure_date: getAllUrlParams().departure_date,
            category: getAllUrlParams().category,
            price: getAllUrlParams().price,
            price_order: price_order,
            status_order: status_order,
        };

        console.log(data);
        
        // Success Function
        var success = function(result) {
            console.log(result);
            
            $('#content-tours').empty();
            $('#content-tours').append(result);
            paginate();
        };

        // Result Type
        var dataType = 'text';

        // Send Ajax
        $.get(url, data, success, dataType);
    }

    function getAllUrlParams(url) {

        // get query string from url (optional) or window
        var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

        // we'll store the parameters here
        var obj = {};

        // if query string exists
        if (queryString) {

        // stuff after # is not part of query string, so get rid of it
        queryString = queryString.split('#')[0];

        // split our query string into its component parts
        var arr = queryString.split('&');

        for (var i = 0; i < arr.length; i++) {
            // separate the keys and the values
            var a = arr[i].split('=');

            // set parameter name and value (use 'true' if empty)
            var paramName = a[0];
            var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

            // (optional) keep case consistent
            paramName = paramName.toLowerCase();
            if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

            // if the paramName ends with square brackets, e.g. colors[] or colors[2]
            if (paramName.match(/\[(\d+)?\]$/)) {

            // create key if it doesn't exist
            var key = paramName.replace(/\[(\d+)?\]/, '');
            if (!obj[key]) obj[key] = [];

            // if it's an indexed array e.g. colors[2]
            if (paramName.match(/\[\d+\]$/)) {
                // get the index value and add the entry at the appropriate position
                var index = /\[(\d+)\]/.exec(paramName)[1];
                obj[key][index] = paramValue;
            } else {
                // otherwise add the value to the end of the array
                obj[key].push(paramValue);
            }
            } else {
            // we're dealing with a string
            if (!obj[paramName]) {
                // if it doesn't exist, create property
                obj[paramName] = paramValue;
            } else if (obj[paramName] && typeof obj[paramName] === 'string'){
                // if property does exist and it's a string, convert it to an array
                obj[paramName] = [obj[paramName]];
                obj[paramName].push(paramValue);
            } else {
                // otherwise add the property
                obj[paramName].push(paramValue);
            }
            }
        }
        }

        return obj;
        }
</script>
@stop