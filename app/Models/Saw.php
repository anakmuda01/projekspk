<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saw extends Model
{
  protected $fillable = [
    'kode','nama','tipe','bobot'
  ];

  public function pegawais()
  {
      return $this->belongsToMany('App\Models\Pegawai')
                  ->withPivot('nilai')
                  ->withTimestamps();
  }
}
