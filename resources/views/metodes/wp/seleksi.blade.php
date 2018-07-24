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
          <th colspan="{{count($krets)}}" style="vertical-align:middle;">Nilai Kreteria</th>
          <tr>
            @foreach ($krets as $k)
              <th>{{$k->kode}}</th>
            @endforeach
          </tr>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegawais as $index=>$p)
          <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$p->nipeg}}</td>
            <td>{{$p->nama_pegawai}}</td>
            @foreach ($p->kreterias->where('metode','wp') as $key => $pk)
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
      <h1>Vektor S Part 1</h1>
      <thead>
        <tr>
          <th rowspan="2" style="vertical-align:middle;">No</th>
          <th rowspan="2" style="vertical-align:middle;">Nipeg</th>
          <th rowspan="2" style="vertical-align:middle;">Nama Pegawai</th>
          <th colspan="{{count($krets)}}" style="vertical-align:middle;">Nilai Kreteria</th>
          <tr>
            @foreach ($krets as $k)
              <th>{{$k->kode}}</th>
            @endforeach
          </tr>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegawais as $index=>$p)
          <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$p->nipeg}}</td>
            <td>{{$p->nama_pegawai}}</td>
            @foreach ($p->kreterias->where('metode','wp') as $key => $pk)
              <td>{{$pk->pivot->nilai}}<sup>{{$pk->pangkat}}</sup></td>
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
      <h1>Vektor S Part 2</h1>
      <thead>
        <tr>
          <th rowspan="2" style="vertical-align:middle;">No</th>
          <th rowspan="2" style="vertical-align:middle;">Nipeg</th>
          <th rowspan="2" style="vertical-align:middle;">Nama Pegawai</th>
          <th colspan="{{count($krets)}}" style="vertical-align:middle;">Nilai Kreteria</th>
          <tr>
            @foreach ($krets as $k)
              <th>{{$k->kode}}</th>
            @endforeach
          </tr>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegawais as $index=>$p)
          <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$p->nipeg}}</td>
            <td>{{$p->nama_pegawai}}</td>
            @foreach ($p->kreterias->where('metode','wp') as $key => $pk)
              <td>{{number_format(pow($pk->pivot->nilai,$pk->pangkat),4)}}</td>
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
          <th rowspan="2" style="vertical-align:middle;">Vektor S</th>
          <th rowspan="2" style="vertical-align:middle;">Nilai Preferensi (V)</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegawais as $index=>$p)
          <tr>
            <th id="row{{$p->id}}">{{$index+1}}</th>
            <td id="nipeg{{$p->id}}">{{$p->nipeg}}</td>
            <td class="nama-produk{{$p->id}}">{{$p->nama_pegawai}}</td>
            <td id="final{{$p->id}}">{{number_format($final[$index],4)}}</td>
            @if ($sum_final == 0)
              <td>0</td>
            @else
              <td id="n{{$p->id}}" class="nilai-ref" data-id="{{$p->id}}">{{number_format($final[$index]/$sum_final,4)}}</td>
            @endif
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
            @foreach ($krets as $index=>$k)
              <tr>
                <td>{{$k->kode}}</td>
                <td>{{$k->nama}}</td>
                @if ($k->tipe == 0)
                  <td>Cost</td>
                @else
                  <td>Benefit</td>
                @endif
                <td>{{$k->bobot}}</td>
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
