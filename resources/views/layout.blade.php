<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment</title>

  <!-- Linking CSS -->


  <!-- Style -->

  <!-- Latest compiled and minified CSS Bootstrap -->
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/paper.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/core.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/normalize.css') }}" rel="stylesheet">
  
  <!-- Datepicker css -->
  <link href="{{ asset('/css/calendar.css') }}" rel="stylesheet">

  <!-- Modernizr -->
  <script src="{{ asset('/js/vendor/modernizr.js') }}"></script>

  <!-- JQuery must be in the header for the calendar to work, I don't know why... -->
  <script src="{{ asset('/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

  <!-- Latest compiled and minified JavaScript Bootstrap -->
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>

  <!-- Moment -->
  <script src="{{ asset('/js/moment.js') }}"></script>

</head>  
<body>
  <div id="url" style="display: none">{{url('')}}</div>

  @yield('content')


</body>
</html>
