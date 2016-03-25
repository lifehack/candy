@extends('layout')
@section('content')


    <div class="row text-center">
        <h1>选择店面</h1>
        @foreach($packages as $package)

            <div class="col-md-4 center-block" style="float:none;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p><a href="booking/calendar/{{ $package->id }}">{{ $package->package_name }}</a><br>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop
