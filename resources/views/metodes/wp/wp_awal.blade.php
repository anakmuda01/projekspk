@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-12">
    <h1 class="text-center">Daftar Kreteria Metode WP</h1>
    <hr>
    <br>
  </div>
  <div class="col-md-12">
    <div class="row justify-content-between">
      <div class="col-md-2 tombol-atas">
        <a href="/pegawai" class="btn btn-warning">BACK</a>
      </div>
      <div class="col-md-8">
        <a class="btn btn-primary tombol-atas" href="/wp/create" role="button">Tambah Kreteria</a>
        <a class="btn btn-secondary tombol-atas" href="/wp/nilai" role="button">Masukkan Nilai Masing-Masing Pegawai</a>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <br>
    @if (Session::has('msg'))
      <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kode Kreteria</th>
          <th scope="col">Nama Kreteria</th>
          <th scope="col">Tipe</th>
          <th scope="col">Bobot</th>
          <th colspan="2" style="text-align:center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($kreterias as $index => $k)
        <tr>
          <th scope="row">{{$index+1}}</th>
          <td>{{$k->kode}}</td>
          <td>{{$k->nama}}</td>
          <td>
            @if ($k->tipe == 0)
              Cost
            @else
              Benefit
            @endif
          </td>
          <td>{{$k->bobot}}</td>
          <td style="text-align:center; width:25px;"><a href="/wp/{{$k->id}}/edit" class="btn btn-warning"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
          <td style="text-align:center; width:25px;">
            <form id="form-delete{{$k->id}}" method="POST" action="/wp/{{$k->id}}">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <button gol="Kreteria Kode" id="{{$k->id}}" btn-name="{{$k->kode}}" class="hapus-btn btn btn-danger hapus-btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
