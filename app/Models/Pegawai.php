<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  protected $fillable = [
   'nipeg','nama_pegawai','vektor_s_wp','v_wp'
  ];

  public function kreterias()
  {
      return $this->belongsToMany('App\Models\Kreteria')
                  ->withPivot('nilai')
                  ->withTimestamps();;
  }

  public function saws()
  {
      return $this->belongsToMany('App\Models\Saw')
                  ->withPivot('nilai')
                  ->withTimestamps();;
  }
}
