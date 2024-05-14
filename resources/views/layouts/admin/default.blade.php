<!doctype html>
<html>
<head>
   @include('includes.admin.head')
   
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300&display=swap" rel="stylesheet">

</head>
<body>
<?php /*<style>
    @font-face {
        font-family: 'Kodchasan-ExtraLight';
        /*src: url("{{ @url('fonts/Kodchasan-ExtraLight.woff')}}") format('woff');//
        src: url('https://nindeo.stgdev.net/fonts/Kodchasan-ExtraLight.woff') format('woff');
    }
    *{ 
      /*font-family: 'Kodchasan-ExtraLight' !important;//
      font-family: 'Kodchasan', sans-serif !important;
    }
    input[type="datetime-local"]::-webkit-calendar-picker-indicator{
      /*font-family: 'Kodchasan-ExtraLight' !important;//
      font-family: 'Kodchasan', sans-serif !important;
    }
</style> */?>

  <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="" src="{{url('images/pre-loader.svg')}}" alt="{{ config('app.name', 'StockPilot') }}" height="60" width="200">
        <!-- <img class="animation__shake" src="{{url('images/pre-loader.svg')}}" alt="{{ config('app.name', 'StockPilot') }}" height="60" width="200"> -->
      </div>
      @include('includes.admin.header')
      @include('includes.admin.sidebar')
      @yield('content')
  </div>
  <!-- ./wrapper -->
</body>
</html>