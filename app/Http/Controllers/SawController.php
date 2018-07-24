<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Saw;
use Illuminate\Http\Request;

class SawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $kret_saws= Saw::all();

      return view('metodes/saw/saw_awal',compact('kret_saws'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create()
     {
         return view('metodes/saw/tambah_kret_saw');
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
        'kode' => 'required|unique:saws|min:1|max:25',
        'nama_kreteria' => 'required|min:1|max:180',
        'bobot' => 'required|min:1|max:10'
      ]);
      $request->tipe = array_diff($request->tipe, [99]);
        if(empty($request->tipe)){
        return redirect('/saw/create')->withInput($request->input())->with('tipe','Silahkan pilih tipe kreteria !');
      }

      $tipes = $request->tipe;
      $x = 99;
      foreach ($tipes as $t) {
        $x = $t;
      }


      $a = $request->kode;
      $b = strtoupper($a);

      $kret_saw = Saw::create([
        'kode' => $b,
        'nama' => $request->nama_kreteria,
        'tipe' => $x,
        'bobot' => $request->bobot/100
      ]);

      return redirect('/saw')->with('msg','Kreteria berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('sampai');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $saw = Saw::findorfail($id);
      if($saw){
        return view('metodes/saw/edit_kret_saw',compact(['saw']));
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
        return redirect('/saw/create')->withInput($request->input())->with('tipe','Silahkan pilih tipe kreteria !');
      }

      $tipes = $request->tipe;
      $x = 99;
      foreach ($tipes as $t) {
        $x = $t;
      }

      $saw = Saw::findOrFail($id);
      if($saw){
        $saw->update([
          'nama' => $request->nama_kreteria,
          'tipe' => $x,
          'bobot' => $request->bobot/100
        ]);
        return redirect('/saw')->with('msg','Data Kreteria: '.$saw->kode.' Berhasil Diupdate~');
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
      $saw = Saw::find($id);

      $saw->delete();

      return redirect('/saw')->with('msg','Kreteria: '.$saw->kode.' berhasil dihapus !');
    }

    public function nilai(){
      $pegawais  = Pegawai::all();
      $kret_saws = Saw::all();

      $status = 0;
      foreach ($pegawais as $p) {
          foreach ($kret_saws as $k) {
              $work = Pegawai::find($p->id);
              $hasNilai = $work->saws()->where('saw_id', $k->id)->exists();
              if($hasNilai){
                $status = 1;
              }else{
                $work->saws()->attach($k->id,['nilai' => 0]);
              }
          }
      }

      $hit = count($kret_saws);
      return view('metodes/saw/nilai_saw',compact(['kret_saws','pegawais','status','hit']));
    }

    public function simpan_nilai(Request $request){

      $pegs = Pegawai::all();
      $kret_saws = Saw::all();

      $nilais = $request->nilai;
      foreach ($pegs as $p) {
          foreach ($kret_saws as $k) {
              $work = Pegawai::find($p->id);
              $hasNilai = $work->saws()->where('saw_id', $k->id)->exists();
              if($hasNilai){
                $work->saws()->updateExistingPivot($k->id,['nilai' => $nilais[$k->id][$p->id]]);
              }else{
                $work->saws()->attach($k->id,['nilai' => $nilais[$k->id][$p->id]]);
              }
          }
      }

      return redirect('/saw/nilai')->with('msg','Data Nilai Berhasil Disimpan~');
    }

    public function seleksi(){

      $kret_saws = Saw::all();
      $pegs = Pegawai::all();

      $tertinggi = [];
      foreach ($kret_saws as $key => $sv) {
        $cok = $sv->pegawais;
        $items = [];
        foreach ($cok as $kc=> $vc) {
          $tod = $vc->pivot->nilai;
          array_push($items, $tod);
          // echo $kc.' dan '. $tod.'<br>';
        }
        array_push($tertinggi,max($items));
      }

      $terendah = [];
      foreach ($kret_saws as $key => $sv) {
        $cok = $sv->pegawais;
        $items = [];
        foreach ($cok as $kc=> $vc) {
          $tod = $vc->pivot->nilai;
          array_push($items, $tod);
          // echo $kc.' dan '. $tod.'<br>';
        }
        array_push($terendah,min($items));
      }

      $final = [];
      foreach ($pegs as $p) {
        foreach ($p->saws as $key => $pk){
          $foo = $pk->pivot->where('pegawai_id',$p->id)->get();
        }

        $up = [];
        foreach ($kret_saws as $c) {
          $s = $c->bobot;
          array_push($up,$s);
        }

        $normal = [];
        foreach ($p->saws as $key => $pk){
          if ($pk->tipe == 0){
            $j = $terendah[$key]/$pk->pivot->nilai;
            array_push($normal,$j);
          }else{
            $j = $pk->pivot->nilai/$tertinggi[$key];
            array_push($normal,$j);
          }
        }

        $hasil = 0;
        foreach ($up as $key => $bobot) {
          $hasil += $normal[$key]*$bobot;
          // echo number_format($normal[$key],4).'dan'.$bobot.' = '.number_format($normal[$key]*$bobot,4).'<br>';
        }

        array_push ($final,$hasil);
      }

      return view('metodes/saw/seleksi',compact(['pegs','kret_saws','tertinggi','terendah','final']));
    }
}
