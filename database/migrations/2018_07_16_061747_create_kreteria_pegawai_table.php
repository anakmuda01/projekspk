<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKreteriaPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kreteria_pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pegawai_id')->unsigned();
            $table->integer('kreteria_id')->unsigned();
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')
            ->on('pegawais')->onDelete('cascade');
            $table->foreign('kreteria_id')->references('id')
            ->on('kreterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kreteria_pegawai');
    }
}
