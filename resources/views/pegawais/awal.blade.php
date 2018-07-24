@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-12">
    <h1 class="text-center">Data Pegawai PT. PLN Area Barabai</h1>
    <hr>
  </div>
  <div class="col-md-12">
    <div class="row justify-content-between">
      <div class="col-md-4 tombol-atas">
        <a class="btn btn-primary" href="/pegawai/create" role="button">Tambah Data</a>
      </div>
      <div class="col-md-4 tombol-atas">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#metode">
          Pilih Metode
        </button>
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
          <th scope="col">Nipeg</th>
          <th scope="col">Nama Pegawai</th>
          <th colspan="2" style="text-align:center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegawais as $index=>$p)
          <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$p->nipeg}}</td>
            <td>{{$p->nama_pegawai}}</td>
            <td style="text-align:center; width:25px;"><a href="/pegawai/{{$p->id}}/edit" class="btn btn-warning"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
            <td style="text-align:center; width:25px;">
              <form id="form-delete{{$p->id}}" method="POST" action="/pegawai/{{$p->id}}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button gol="Pegawai Nipeg" id="{{$p->id}}" btn-name="{{$p->nipeg}}" class="hapus-btn btn btn-danger hapus-btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="metode" tabindex="-1" role="dialog" aria-labelledby="metodeTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="metodeTitle">Pilih Metode SPK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <a href="/wp" class="btn btn-success">Metode WP</a>
        <hr>
        <a href="/saw" class="btn btn-success">Metode SAW</a>
        {{-- <hr>
        <a href="#" class="btn btn-success">Metode TOPSIS</a> --}}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
