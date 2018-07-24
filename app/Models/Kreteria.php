<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kreteria extends Model
{
  protected $fillable = [
   'metode','kode','nama','tipe','bobot','N','pangkat'
  ];

  public function pegawais()
  {
      return $this->belongsToMany('App\Models\Pegawai')
                  ->withPivot('nilai')
                  ->withTimestamps();
  }
}
