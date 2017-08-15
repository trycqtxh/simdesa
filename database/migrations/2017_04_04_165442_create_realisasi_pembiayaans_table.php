<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealisasiPembiayaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_pembiayaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_bukti', 20);
            $table->date('tanggal');
            $table->enum('metode', ['Tunai', 'Bank']);
            $table->string('uraian');
            $table->integer('jumlah', false, true);
            $table->unsignedInteger('pembiayaan_id');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('pembiayaan_id')->references('id')->on('pembiayaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisasi_pembiayaan');
    }
}
