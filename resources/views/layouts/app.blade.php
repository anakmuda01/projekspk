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
    <script src="{{asset('js/jquery-3.3.1.slim.js')}}" charset="utf-8"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/spk.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-spk">
            <div class="container">
                <a class="navbar-brand logo" href="{{ url('/') }}">
                    <i class="fa fa-home" aria-hidden="true"></i> Home <span class="judul-spk">| SPK Pemilihan Pegawai Teladan PT. PLN Area Barabai</span>
                </a>
                <button class="navbar-toggler aww" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li> --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle logo" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item keluar" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
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

<script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var max = 0;
        var yoi = 0;
        var p = "";
        $('.nilai-ref').each(function()
        {
           var ganal = $(this).text();
           if (ganal > max){
             max = ganal;
             yoi = $(this).data('id');
           }
        });
        $('#row'+yoi).addClass('selected');
        $('#final'+yoi).addClass('selected');
        $('#nipeg'+yoi).addClass('selected');
        $('.nama-produk'+yoi).addClass('selected');
        $('#n'+yoi).addClass('selected');
        $('#produknya').text(p);
        $('#nilai').text(max);
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('#content').toggleClass('active');
            $('.collapse.show').toggleClass('show');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });

        $('.hapus-btn').on('click', function(e){
            e.preventDefault();
            var judul = $(this).attr('btn-name');
            var idbtn = $(this).attr('id');
            var gol = $(this).attr('gol');
            swal({
              title: "HAPUS DATA dari <br>"+gol+" <span class='judul-hps'>"+judul+"</span> ?",
              html: '<p class="psn-warning">Data yang telah dihapus tidak bisa dikembalikan lagi ...</p>',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, hapus data!',
              cancelButtonText: 'No, gak jadi!',
              confirmButtonClass: 'btn btn-danger tombol-hps btn-lg',
              cancelButtonClass: 'btn btn-success',
              buttonsStyling: false,
              focusConfirm: false,
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                swal(
                  'Terhapus!',
                  'Data dari <span class="judul-hps">'+judul+'</span> telah dihapus.',
                  'success'
                ).then((result) => {
                  if (result.value){
                    $('#form-delete'+idbtn).submit();
                  }else{
                    $('#form-delete'+idbtn).submit();
                  }
                })
              } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
              ) {
                swal(
                  'Gak jadi dihapus~',
                  '',
                  'error'
                )
              }
            })
        });

      });
    </script>

</body>
</html>
