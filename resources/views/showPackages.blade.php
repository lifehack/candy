@extends('layout')
@section('content')

    <div style="border-right-width: 0px;" class="row text-center" >
        <h1 style="color:white" class="text-center">预约录音</h1>
        <h3 style="color:white;font-size: medium;width:90%" class="text-left">&nbsp&nbsp&nbsp&nbsp选择店面：</h3>
            <style>
                .a1{
                    color:white;  }

                .a2{
                    color:dodgerblue;  }
            </style>
            <script>
                function change(x)
                {
                    for(h=1;h<7;h++){
                        document.getElementById("cia"+h).className='a1'
                        document.getElementById("cia"+x).className='a2'
                    }
                }
            </script>
        <table class="a1" cellspacing="1" cellpadding="0" style="color:white;background-color:black;font-size:small;height:35px" align="center"  border="0">
            <tr>
                @foreach($shops as $shop)
                    <td> &nbsp </td>
                    <td  class="a1" onmouseover="change({{$shop->id}})" id="cia{{$shop->id}}" value="{{$shop->id}}">{{ $shop->shop_name }}</td>
                    <td> &nbsp </td>
                @endforeach
            </tr>
        </table>

        <div style="background-color: #424242" class="col-md-6">

            <select style="width:94%;color:white;position:relative; left:3%;background-color: black" id="shop" class="form-control">
                @foreach($shops as $shop)
                    <option value="{{$shop->id}}">{{ $shop->shop_name }}</option>
                @endforeach
            </select>

        </div>
        <div>
            @foreach($shops as $shop)
            <img width="94%" height="15%" src="image/{{$shop->shop_name }}.jpg"> </img>
            @endforeach
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
                        <a href="tel:010-12345678">拨号</a>
                    </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!-- Calendar Functionality -->
    <script src="{{ asset('/js/calendar.js') }}"></script>
@stop
