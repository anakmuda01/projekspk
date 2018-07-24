@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="text-center">Masukkan Data-Data Kreteria</h1>
      </div>
      <div class="col-md-6">
        <br>
        <form action="/wp/{{$wp->id}}" method="post">
          {{ csrf_field() }}
          <input name="metode" type="hidden" value="wp">
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text span-input">Kode Kreteria</span>
              </div>
              <input readonly name="kode" type="text" class="form-control" style="text-transform:uppercase" value="{{(old('kode')) ? old('kode') : $wp->kode}}">
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
              <input name="nama_kreteria" type="text" class="form-control" placeholder="Masukkan Nama Kreteria..." value="{{(old('nama_kreteria')) ? old('nama_kreteria') : $wp->nama}}">
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
                <option value="0"
                @if ($wp->tipe == 0)
                  selected="selected"
                @endif
                >Cost</option>
                <option value="1"
                @if ($wp->tipe == 1)
                  selected="selected"
                @endif
                >Benefit</option>
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
              <input name="bobot" type="text" class="form-control" placeholder="Masukkan Bobot..." value="{{(old('bobot')) ? old('bobot') : $wp->bobot}}">
            </div>
          </div>
          <div class="form-group">
            <input type="hidden" name="_method" value="PUT">
            <button class="btn btn-success btn-block">UPDATE DATA</button>
          </div>
        </form>
        <div class="col-md-12">
          <a href="/wp" class="btn btn-warning btn-block">BACK</a>
        </div>
      </div>
  </div>
</div>
@endsection
