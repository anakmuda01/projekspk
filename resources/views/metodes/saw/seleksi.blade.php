@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-12">
    <h1 class="text-center">Data Seleksi Pegawai PLN</h1>
    <hr>
    <div class="row justify-content-between">
      <div class="col-md-4 tombol-atas">
        <a href="/wp/nilai" class="btn btn-warning">BACK</a>
      </div>
      <div class="col-md-4 tombol-atas">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#metode">
          Informasi Kreteria
        </button>
      </div>
      <div class="col-md-2 tombol-atas">
        <a href="/pegawai" class="btn btn-warning">Ke data Pegawai</a>
      </div>
    </div>
    <br>
  </div>
  <div class="col-md-12">
    <br>
    @if (Session::has('msg'))
      <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif
    <table class="table table-striped">
      <h1>Nilai Masing-Masing Alternatif</h1>
      <thead>
        <tr>
          <th rowspan="2" style="vertical-align:middle;">No</th>
          <th rowspan="2" style="vertical-align:middle;">Nipeg</th>
          <th rowspan="2" style="vertical-align:middle;">Nama Pegawai</th>
          <th colspan="{{count($kret_saws)}}" style="vertical-align:middle;">Nilai Kreteria</th>
          <tr>
            @foreach ($kret_saws as $k)
              <th>{{$k->kode}}</th>
            @endforeach
          </tr>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegs as $index=>$p)
          <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$p->nipeg}}</td>
            <td>{{$p->nama_pegawai}}</td>
            @foreach ($p->saws as $key => $pk)
              <td>{{$pk->pivot->nilai}}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-md-12">
    <br>
    @if (Session::has('msg'))
      <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif
    <table class="table table-striped">
      <h1>Normalisasi Nilai</h1>
      <thead>
        <tr>
          <th rowspan="2" style="vertical-align:middle;">No</th>
          <th rowspan="2" style="vertical-align:middle;">Nipeg</th>
          <th rowspan="2" style="vertical-align:middle;">Nama Pegawai</th>
          <th colspan="{{count($kret_saws)}}" style="vertical-align:middle;">Nilai Kreteria</th>
          <tr>
            @foreach ($kret_saws as $k)
              <th>{{$k->kode}}</th>
            @endforeach
          </tr>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegs as $index=>$p)
          <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$p->nipeg}}</td>
            <td>{{$p->nama_pegawai}}</td>
            @foreach ($p->saws as $key => $pk)
              @if ($pk->tipe == 0)
                <td>{{number_format($terendah[$key]/$pk->pivot->nilai,4)}}</td>
              @else
                <td>{{number_format($pk->pivot->nilai/$tertinggi[$key],4)}}</td>
              @endif
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-md-12">
    <br>
    @if (Session::has('msg'))
      <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif
    <table class="table table-striped">
      <h1>Nilai Perangkingan</h1>
      <thead>
        <tr>
          <th rowspan="2" style="vertical-align:middle;">No</th>
          <th rowspan="2" style="vertical-align:middle;">Nipeg</th>
          <th rowspan="2" style="vertical-align:middle;">Nama Pegawai</th>
          <th rowspan="2" style="vertical-align:middle;">Nilai Preferensi (V)</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegs as $index=>$p)
          <tr>
            <th id="row{{$p->id}}">{{$index+1}}</th>
            <td id="nipeg{{$p->id}}">{{$p->nipeg}}</td>
            <td class="nama-produk{{$p->id}}">{{$p->nama_pegawai}}</td>
            <td id="n{{$p->id}}" class="nilai-ref" data-id="{{$p->id}}">{{number_format($final[$index],4)}}</td>
            <td id="tes{{$p->id}}"></td>
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
        <h5 class="modal-title" id="metodeTitle">Informasi Kreteria </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align:middle;">Kode Kreteria</th>
              <th rowspan="2" style="vertical-align:middle;">Nama Kreteria</th>
              <th rowspan="2" style="vertical-align:middle;">Tipe Kreteria</th>
              <th rowspan="2" style="vertical-align:middle;">Bobot Kreteria</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kret_saws as $index=>$k)
              <tr>
                <td>{{$k->kode}}</td>
                <td>{{$k->nama}}</td>
                @if ($k->tipe == 0)
                  <td>Cost</td>
                @else
                  <td>Benefit</td>
                @endif
                <td>{{$k->bobot*100}} %</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
