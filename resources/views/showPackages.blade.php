@extends('layout')
@section('content')

    <div style="border-right-width: 0px;" class="row text-center">
        <h1 style="color:white" class="text-center">预约录音</h1>
        <h3 style="color:white;font-size: medium;width:90%" class="text-left">&nbsp&nbsp&nbsp&nbsp选择店面：</h3>
        <table class="a1" cellspacing="1" cellpadding="0"
               style="color:white;background-color:black;font-size:small;height:35px" align="center" border="0">
            <tr>
                @foreach($shops as $shop)
                    <td> &nbsp</td>
                    <td onclick="change({{$shop->id}})" id="shop{{$shop->id}}"
                        value="{{$shop->id}}">{{ $shop->shop_name }}</td>
                    <td> &nbsp</td>
                @endforeach
            </tr>
        </table>

        <div class="row">
            <img width="94%" height="15%" id="shop_image" src="img/shop1.jpg"> </img>
        </div>

        <h1 style="color:white;font-size: medium" class="text-left"> &nbsp&nbsp&nbsp&nbsp选择时间：</h1>

        <div class="col-md-11 text-center">
            <div style="background-color: white" class="col-md-offset-4 col-lg-offset-5 col-md-2 col-lg-1">
                <div id="calendar"></div>
            </div>
            <div style="background-color: white" class="col-md-offset-1 col-lg-offset-1 col-md-2 col-lg-1">
                <div class="panel panel-primary">
                    <div class="panel-heading" id="daySelect" style="background-color: black">
                        点击日期
                    </div>
                    <div class="panel-body">
                        <p id="dayTimes"></p>

                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading" id="daySelect" style="background-color: black">
                            <p value="id"></p>
                            <a id="shop_phone" href="">点击拨打预约电话</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Calendar Functionality -->
    <script src="{{ asset('/js/calendar.js') }}"></script>
@stop
