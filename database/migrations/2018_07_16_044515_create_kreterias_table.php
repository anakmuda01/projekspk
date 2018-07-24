<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKreteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kreterias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('metode',35);
            $table->string('kode',35);
            $table->string('nama',180);
            $table->integer('tipe')->default('0');
            $table->integer('bobot')->default('0');
            $table->integer('N')->default('0');
            $table->integer('pangkat')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kreterias');
    }
}
