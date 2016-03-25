<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/fullcalendar.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/paper.css') }}" rel="stylesheet">

  <script src="{{ asset('/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

  <script src="{{ asset('/js/moment.js') }}"></script>
  <script src="{{ asset('/js/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
</head>
<body>
  <div id="url" style="display: none">{{url('')}}</div>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Booking</a>
      </div>

      <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 1px;">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('admin/appointments') }}">Appointments<span class="sr-only">(current)</span></a></li>
          <li><a href="{{ url('admin/availability') }}">Availability</a></li>
          <li><a href="{{ url('admin/packages') }}">Packages</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Log Out</a></li>
        </ul>
      </div>
    </div>
  </nav>
  @yield('content')
</body>
</html>