<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiSawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_saw', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('pegawai_id')->unsigned();
          $table->integer('saw_id')->unsigned();
          $table->integer('nilai');
          $table->timestamps();

          $table->foreign('pegawai_id')->references('id')
          ->on('pegawais')->onDelete('cascade');
          $table->foreign('saw_id')->references('id')
          ->on('saws')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai_saw');
    }
}
