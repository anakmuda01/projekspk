<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pegawais = Pegawai::all();

      return view('pegawais/awal',compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawais/tambah');
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
          'nipeg' => 'required|unique:pegawais|min:1|max:35',
          'nama_pegawai' => 'required|min:1|max:180',
        ]);

        $a = $request->nipeg;
        $b = strtoupper($a);

        $pegawai = Pegawai::create([
          'nipeg' => $b,
          'nama_pegawai' => $request->nama_pegawai,
        ]);

        return redirect('/pegawai')->with('msg','Data Pegawai Berhasil Disimpan~');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $peg = Pegawai::findorfail($id);
      if($peg){
        return view('pegawais/edit',compact(['peg']));
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
        'nama_pegawai' => 'required|min:1|max:180',
      ]);

      $a = $request->nipeg;
      $b = strtoupper($a);

      $peg = Pegawai::findOrFail($id);
      if($peg){
        $peg->update([
          'nama_pegawai' => $request->nama_pegawai
        ]);
        return redirect('/pegawai')->with('msg','Data Pegawai: '.$peg->nipeg.' Berhasil Diupdate~');
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
      $pegawai = Pegawai::find($id);

      $pegawai->delete();

      return redirect('/pegawai')->with('msg','NIPEG: '.$pegawai->nipeg.' berhasil dihapus !');
    }
}
