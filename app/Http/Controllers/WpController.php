<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kreteria;
use Illuminate\Http\Request;

class WpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $kreterias= Kreteria::where('metode','wp')->get();

      return view('metodes/wp/wp_awal',compact('kreterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metodes/wp/tambah_kret_wp');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'kode' => 'required|unique:kreterias|min:1|max:25',
        'nama_kreteria' => 'required|min:1|max:180',
        'bobot' => 'required|min:1|max:10'
      ]);

      $request->tipe = array_diff($request->tipe, [99]);
        if(empty($request->tipe)){
        return redirect('/wp/create')->withInput($request->input())->with('tipe','Silahkan pilih tipe kreteria !');
      }

      $tipes = $request->tipe;
      $x = 99;
      foreach ($tipes as $t) {
        $x = $t;
      }

      $a = $request->kode;
      $b = strtoupper($a);

      $kreteria = Kreteria::create([
        'metode' => $request->metode,
        'kode' => $b,
        'nama' => $request->nama_kreteria,
        'tipe' => $x,
        'bobot' => $request->bobot
      ]);

      $pegs = Pegawai::all();
      $krets = Kreteria::where('metode','wp')->get();
      foreach ($pegs as $p) {
        $work = Pegawai::find($p->id);
        if ($work) {
          foreach ($krets as $k) {
            $work = Pegawai::find($p->id);
            $hasNilai = $work->kreterias()->where('kreteria_id', $k->id)->exists();
            if(!$hasNilai){
              $work->kreterias()->attach($k->id,['nilai' => 0]);
            }
          }
        }
      }

      return redirect('/wp')->with('msg','Kreteria berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $wp = Kreteria::findorfail($id);
      if($wp){
        return view('metodes/wp/edit_kret_wp',compact(['wp']));
      } else{
        abort(404);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'nama_kreteria' => 'required|min:1|max:180',
        'bobot' => 'required|min:1|max:10'
      ]);

      $request->tipe = array_diff($request->tipe, [99]);
        if(empty($request->tipe)){
        return redirect('/wp/'.$id.'/edit')->withInput($request->input())->with('tipe','Silahkan pilih tipe kreteria !');
      }

      $tipes = $request->tipe;
      $x = 99;
      foreach ($tipes as $t) {
        $x = $t;
      }

      $wp = Kreteria::findOrFail($id);
      if($wp){
        $wp->update([
          'nama' => $request->nama_kreteria,
          'tipe' => $x,
          'bobot' => $request->bobot
        ]);
        return redirect('/wp')->with('msg','Data Kreteria: '.$wp->kode.' Berhasil Diupdate~');
      }else{
        abort(404);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $kreteria = Kreteria::find($id);

      $kreteria->delete();

      return redirect('/wp')->with('msg','Kreteria: '.$kreteria->kode.' berhasil dihapus !');
    }

    public function nilai(){
      $pegawais  = Pegawai::all();
      $kreterias = Kreteria::where('metode','wp')->get();

      $status = 0;
      foreach ($pegawais as $p) {
          foreach ($kreterias as $k) {
              $work = Pegawai::find($p->id);
              $hasNilai = $work->kreterias()->where('kreteria_id', $k->id)->exists();
              if($hasNilai){
                $status = 1;
              }else{
                $work->kreterias()->attach($k->id,['nilai' => 0]);
              }
          }
      }

      $sum_bobot = 0;
      foreach ($kreterias as $key => $value) {
        $sum_bobot += $value->bobot;
      }

      $normal = [];
      foreach ($kreterias as $index => $v){
        $n = number_format($v->bobot/$sum_bobot,2);
        array_push($normal,$n);
        $u = Kreteria::where('id',$v->id)->update(['N'=> $n]);
      }

      $normal = [];
      foreach ($kreterias as $index => $v){
        $n = number_format($v->bobot/$sum_bobot,2);
        array_push($normal,$n);
        if($v->tipe == 0){
          $n = $n *-1;
        }
        $u = Kreteria::where('id',$v->id)->update(['pangkat'=> $n]);
      }

      $hit = count($kreterias);
      return view('metodes/wp/nilai_wp',compact(['kreterias','pegawais','status','hit']));
    }

    public function simpan_nilai(Request $request){

      $pegs = Pegawai::all();
      $krets = Kreteria::where('metode','wp')->get();

      $nilais = $request->nilai;
      foreach ($pegs as $p) {
          foreach ($krets as $k) {
              $work = Pegawai::find($p->id);
              $hasNilai = $work->kreterias()->where('kreteria_id', $k->id)->exists();
              if($hasNilai){
                $work->kreterias()->updateExistingPivot($k->id,['nilai' => $nilais[$k->id][$p->id]]);
              }else{
                $work->kreterias()->attach($k->id,['nilai' => $nilais[$k->id][$p->id]]);
              }
          }
      }

      return redirect('/wp/nilai')->with('msg','Data Nilai Berhasil Disimpan~');
    }

    public function seleksi(){

      $krets = Kreteria::where('metode','wp')->get();

      // foreach ($krets as $key => $value) {
      //   if($value->tipe == 0){
      //     $nor [] = number_format($value->bobot/$sum_bobot,2) * -1;
      //   }else{
      //     $nor [] = number_format($value->bobot/$sum_bobot,2);
      //   }
      // }

      $sum_bobot = 0;
      foreach ($krets as $key => $value) {
        $sum_bobot += $value->bobot;
      }

      $normal = [];
      foreach ($krets as $index => $v){
        $n = number_format($v->bobot/$sum_bobot,2);
        array_push($normal,$n);
        $u = Kreteria::where('id',$v->id)->update(['N'=> $n]);
      }

      $normal = [];
      foreach ($krets as $index => $v){
        $n = number_format($v->bobot/$sum_bobot,2);
        array_push($normal,$n);
        if($v->tipe == 0){
          $n = $n *-1;
        }
        $u = Kreteria::where('id',$v->id)->update(['pangkat'=> $n]);
      }

      $pegs = Pegawai::all();

      $final = [];
      foreach ($pegs as $p) {
        $work = $p->kreterias->where('metode','wp');
        foreach ($work as $key => $value){
          $foo = $value->pivot->where('pegawai_id',$p->id)->get();
        }

        $up = [];
        foreach ($krets as $c) {
          $s = $c->pangkat;
          array_push($up,$s);
        }

        $q = [];
        foreach ($foo as $z => $bar) {
          array_push($q,$bar->nilai);
        }

        // foreach ($q as $key => $value) {
        //   echo $value.'<br>';
        // }

        $v = [];
        $tes = 1;
        foreach ($up as $key => $value) {
          array_push($v, pow($q[$key],$value));
          $tes *= pow($q[$key],$value);
          // echo $q[$key].'dan'.$value.' = '.pow($q[$key],$value).'<br>';
        }

        array_push ($final,$tes);
      }

      // foreach ($final as $key => $value) {
      //   echo $value.'<br>';
      // }

      $sum_final=0;
      foreach ($final as $kunci => $fn) {
        $sum_final += $fn;
      }

      $pegawais = Pegawai::all();
      return view('metodes/wp/seleksi',compact(['pegawais','krets','sum_bobot','final','sum_final']));
    }
}
