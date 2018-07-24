@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="text-center">Masukkan Data-Data Pegawai</h1>
      </div>
      <div class="col-md-6">
        <br>
        <form action="/pegawai" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            @if ($errors->has('nipeg'))
              <span style="color:red;">{{$errors->first('nipeg')}}</span>
            @endif
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text span-input">NIPEG</span>
              </div>
              <input name="nipeg" type="text" class="form-control" placeholder="Masukkan NIPEG..."  style="text-transform:uppercase">
            </div>
          </div>
          <div class="form-group">
            @if ($errors->has('nama_pegawai'))
              <span style="color:red;">{{$errors->first('nama_pegawai')}}</span>
            @endif
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text span-input">Nama Pegawai</span>
              </div>
              <input name="nama_pegawai" type="text" class="form-control" placeholder="Masukkan Nama Pegawai...">
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-success btn-block">SIMPAN DATA</button>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection
