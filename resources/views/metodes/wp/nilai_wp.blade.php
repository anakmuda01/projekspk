@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-12">
      <h1 class="text-center">Data Nilai Masing-masing Kreteria Metode WP</h1>
      <hr>
      <div class="row justify-content-between">
        <div class="col-md-4 tombol-atas">
          <a href="/wp" class="btn btn-warning">BACK</a>
        </div>
        <div class="col-md-2 tombol-atas">
          <a href="/wp/seleksi" class="btn btn-success">Menuju Seleksi</a>
        </div>
      </div>
      <br>
    </div>
    <div class="col-md-12">
      <br>
      @if (Session::has('msg'))
        <div class="alert alert-success">{{ Session::get('msg') }}</div>
      @endif
      <form action="/wp-nilai" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="metode" value="wp">
        <table class="table table-striped table-nilai">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align:middle;">No</th>
              <th rowspan="2" style="vertical-align:middle;">Nipeg</th>
              <th rowspan="2" style="vertical-align:middle;">Nama Pegawai</th>
              <th colspan="{{$hit}}" style="vertical-align:middle;">Nilai Kreteria</th>
              <tr>
                @foreach ($kreterias as $k)
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
                @if ($status == 1)
                  @foreach ($p->kreterias->where('metode','wp') as $pk)
                  <td><input required name="nilai[{{$pk->id}}][{{$p->id}}]" type="number"
                    value="{{$pk->pivot->nilai}}" min="1" max="1000" style="width:5em;"></td>
                  @endforeach
                @else
                  @foreach ($kreterias as $k)
                  <td><input required name="nilai[{{$k->id}}][{{$p->id}}]" type="number"
                    value="" min="1" max="1000" style="width:5em;"></td>
                  @endforeach
                @endif
              </tr>

            @endforeach
          </tbody>
        </table>
        <div class="form-group">
          <button class="btn btn-success btn-block">SIMPAN DATA</button>
        </div>
      </form>
    </div>
  </div>

  {{-- @foreach ($kreterias as $k)
  <td><input required name="nilai[{{$k->id}}][{{$p->id}}]" type="number"
    value="" min="1" max="1000" style="width:5em;"></td>
  @endforeach --}}
@endsection
