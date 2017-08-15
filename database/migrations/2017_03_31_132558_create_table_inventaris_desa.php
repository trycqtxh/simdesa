<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInventarisDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_desa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_barang', 100);
            $table->tinyInteger('asal_sendiri');
            $table->tinyInteger('asal_pemerintah');
            $table->tinyInteger('asal_provinsi');
            $table->tinyInteger('asal_kota');
            $table->tinyInteger('asal_sumbangan');
            $table->tinyInteger('awal_tahun_baik');
            $table->tinyInteger('awal_tahun_rusak');
            $table->tinyInteger('hapus_rusak');
            $table->tinyInteger('hapus_dijual');
            $table->tinyInteger('hapus_disumbangkan');
            $table->date('hapus_tanggal');
            $table->tinyInteger('akhir_tahun_baik');
            $table->tinyInteger('akhir_tahun_rusak');
            $table->string('keterangan');
            $table->unsignedInteger('penanggung_jawab_id');
            $table->timestamps();

            $table->foreign('penanggung_jawab_id')->references('id')->on('aparat_desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris_desa');
    }
}
