<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SPK PT. PLN Area Barabai') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      html, body {
        height: 100%;
      }
      body{
        font-family: 'Aldrich', sans-serif;
      }
      .foto-lihin{
        max-width:318px;
        max-height:183px;
        width: auto;
        height: auto;
      }
      .foto-abdi{
        max-width:155px;
        max-height:183px;
        width: auto;
        height: auto;
      }
      .foto-wahyu{
        max-width:318px;
        max-height:210px;
        width: auto;
        height: auto;
      }
      .nama-user{
        color : red;
      }
      .body-foto{
        padding-top: 0;
        padding-left: 1em;
      }
      .card-foto{
        border: none;
      }
      .wrap {
        min-height: 100%;
      }

      .maen {
        overflow:auto;
      }

      .footer-warpper {
        position: relative;
        margin-top: 0px; /* negative value of footer height */
        clear:both;
        padding-top:20px;
        background-color: #361101;
        color: white;
      }
      .middle-footer{
        padding-top: 1em;
      }
      .isi{
        padding-left: 11em;
      }
      .middle-footer span{
        color: green;
      }
      .top-footer{
        height: 2em;
        background-color: black;
      }
      .bottom-footer{
        padding: 1em;
        background-color: black;
      }
      .bottom-footer p{
        margin: auto;
      }
      .navbar-spk{
        background-color: #361101 !important;
      }
      .navbar-spk a{
        color : white !important;
      }
      @media screen and (max-width: 480px) {
        .isi{
          padding-left: 2em;
        }
        .judul-spk{
          display:none;
        }
      }
    </style>
</head>
<body>
    <div id="app" class="warp">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-spk">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-home" aria-hidden="true"></i> Home <span class="judul-spk">| SPK Pemilihan Pegawai Teladan PT. PLN Area Barabai</span>
                </a>
            </div>
        </nav>

        <main class="py-4 maen">
            @yield('content')
        </main>

        <div class="container-fluid footer-warpper">
          <div class="row">

            <div class="col-md-12 middle-footer">
              <div class="row">
                <div class="col-md-4 isi">
                  <span>ABOUT</span> <br>
                  Projek UAS <br>
                  SPK Pemilihan Pegawai Teladan PT. PLN Area Barabai <br>
                  6B Non Reg Banjarbaru
                </div>
                <div class="col-md-4 isi">
                  <span>KONTAK</span> <br>
                  085247711065 <br>
                </div>
                <div class="col-md-4 isi">
                  <span>INFORMASI</span> <br>
                  FAQ <br>
                  HELP<br>
                </div>
              </div>
              <br>
            </div>

            <div class="col-md-12 bottom-footer my-auto">
              <p class="text-center">&copy; 2018 SPK UAS UNISKA 6B Non Reg Banjarbaru</p>
            </div>
          </div>
        </div>

    </div>
</body>
</html>
