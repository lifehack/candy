@extends('layout')
@section('content')

    <div class="row jumbotron text-center">
        <h1>店面预约</h1>
        <p id="currentDate">  </p>
        <div class="col-md-6">
            <select id="shop" class="form-control">
                @foreach($shops as $shop)
                    <option value="{{$shop->id}}">{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-11 text-center">
        <div class="col-md-offset-4 col-lg-offset-5 col-md-2 col-lg-1">
            <div id="calendar"></div>
        </div>
        <div class="col-md-offset-1 col-lg-offset-1 col-md-2 col-lg-1">
            <div class="panel panel-primary">
                <div class="panel-heading" id="daySelect">
                    点击日期
                </div>
                <div class="panel-body">
                    <p id="dayTimes"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Functionality -->
    <script src="{{ asset('/js/calendar.js') }}"></script>
@stop
