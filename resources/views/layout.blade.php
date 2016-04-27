<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>糖果录音棚</title>

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
<body style="background-color: #424242">

    <div id="url" style="display:none">{{url('')}}</div>
    <div class="row" align="right">
      <img  style="background-color:black;padding-left: 10%" width="100%" src="img/lo.jpg"> </img>
    </div>

    <div style="border-right-width: 0px" class="row text-center">
      <table class="a1" cellspacing="0" cellpadding="10" width=100%"
           style="color:white;background-color:black;width: 100%; font-size: smaller" align="center" border="0">

        <tr>

          <td style="padding-left: 4%;word-break: normal" align="center">&nbsp&nbsp预约录音</td>

          <td style="padding-left: 4%;word-break: normal" align="center">mv欣赏</td>

          <td style="padding-left: 4%;word-break: normal" align="center">歌曲欣赏</td>

          <td style="padding-left: 4%;word-break: normal" align="center">精彩活动&nbsp</td>

        </tr>

        <tr>
          <td style="padding-left: 4%;" align="center">&nbsp&nbsp&nbsp</td>

          <td style="padding-left: 4%;word-break: normal" align="center">(暂未开放)</td>

          <td style="padding-left: 4%;word-break: normal" align="center">(暂未开放)</td>

          <td style="padding-left: 4%;word-break: normal" align="center">(暂未开放)&nbsp</td>

        </tr>
      </table>
    </div>

  @yield('content')


</body>
</html>
