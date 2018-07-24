@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="text-center">Masukkan Data-Data Kreteria</h1>
      </div>
      <div class="col-md-6">
        <br>
        <form action="/wp" method="post">
          {{ csrf_field() }}
          <input name="metode" type="hidden" value="wp">
          <div class="form-group">
            @if ($errors->has('kode'))
              <span style="color:red;">{{$errors->first('kode')}}</span>
            @endif
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text span-input">Kode Kreteria</span>
              </div>
              <input name="kode" type="text" class="form-control" placeholder="Masukkan Kode Kreteria..."  style="text-transform:uppercase" value="{{old('kode')}}">
            </div>
          </div>
          <div class="form-group">
            @if ($errors->has('nama_kreteria'))
              <span style="color:red;">{{$errors->first('nama_kreteria')}}</span>
            @endif
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text span-input">Nama Kreteria</span>
              </div>
              <input name="nama_kreteria" type="text" class="form-control" placeholder="Masukkan Nama Kreteria..." value="{{old('nama_kreteria')}}">
            </div>
          </div>
          <div class="form-group">
            @if(session('tipe'))
              <span style="color:red;">{{session('tipe')}}</span>
            @endif
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text span-input">Tipe</span>
              </div>
              <select class="form-control" name="tipe[]" id="tipe">
                <option value="99">Pilih Tipe</option>
                <option value="0">Cost</option>
                <option value="1">Benefit</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            @if ($errors->has('bobot'))
              <span style="color:red;">{{$errors->first('bobot')}}</span>
            @endif
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text span-input">Bobot</span>
              </div>
              <input name="bobot" type="text" class="form-control" placeholder="Masukkan Bobot..." value="{{old('bobot')}}">
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-success btn-block">SIMPAN DATA</button>
          </div>
        </form>
        <div class="col-md-12">
          <a href="/wp" class="btn btn-warning btn-block">BACK</a>
        </div>
      </div>
  </div>
</div>
@endsection
