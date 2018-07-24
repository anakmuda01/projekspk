@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Anggota Kelompok</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="card">
                                  <div class="card-body">
                                    <table class="table">
                                      <tbody>
                                        <tr>
                                          <td>Nama</td>
                                          <td>Fathurrahman Sholihin</td>
                                        </tr>
                                        <tr>
                                          <td>NIM</td>
                                          <td>15.63.0674</td>
                                        </tr>
                                        <tr>
                                          <td>Kelas</td>
                                          <td>6B Non Reg Banjarbaru</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="card card-foto">
                                  <div class="card-body body-foto">
                                    <img class="foto-lihin" src="{{asset('img/sholihin.jpg')}}" alt="sholihin">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="card">
                                  <div class="card-body">
                                    <table class="table">
                                      <tbody>
                                        <tr>
                                          <td>Nama</td>
                                          <td>Ahmad Abdiannor</td>
                                        </tr>
                                        <tr>
                                          <td>NIM</td>
                                          <td>15.63.0637</td>
                                        </tr>
                                        <tr>
                                          <td>Kelas</td>
                                          <td>6B Non Reg Banjarbaru</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="card card-foto">
                                  <div class="card-body body-foto">
                                    <img class="foto-abdi" src="{{asset('img/abdi.jpg')}}" alt="abdi">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="card">
                                  <div class="card-body">
                                    <table class="table">
                                      <tbody>
                                        <tr>
                                          <td>Nama</td>
                                          <td>Wahyu Syawaliani</td>
                                        </tr>
                                        <tr>
                                          <td>NIM</td>
                                          <td>15.63.0435</td>
                                        </tr>
                                        <tr>
                                          <td>Kelas</td>
                                          <td>6B Non Reg Banjarbaru</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="card card-foto">
                                  <div class="card-body body-foto">
                                    <img class="foto-wahyu" src="{{asset('img/wahyu.jpg')}}" alt="wahyu">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>

                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Login Info</div>

                <div class="card-body">
                  @guest
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">

                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                            </div>
                            <input placeholder="Masukkan Email..." id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Email atau password salah~</strong>
                                </span>
                            @endif
                          </div>

                        </div>

                        <div class="form-group row">

                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                            </div>
                            <input placeholder="Masukkan password..." id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Email atau password salah~</strong>
                                </span>
                            @endif
                          </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        ingat saya
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Masuk
                                </button>
                            </div>
                        </div>
                    </form>
                  @else
                    <h5 class="card-title">Hello !! <span class="nama-user">{{ Auth::user()->name }} ~</span></h5>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    <button class="btn btn-secondary btn-block">Log Out</button>
                    </form>
                    <hr>
                    <a href="/pegawai" class="btn btn-success btn-block">Mulai SPK</a>
                  @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
