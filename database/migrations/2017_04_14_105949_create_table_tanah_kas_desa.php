<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTanahKasDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanah_kas_desa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asal_tanah');
            $table->string('nomor_sertifikat');
            $table->string('kelas', 20);
            $table->tinyInteger('luas');
            $table->enum('peroleh_tkd', ['Asli Milik Desa', 'Pemerintah', 'Provinsi', 'Kabupaten', 'Lain-lain']);
            $table->tinyInteger('luas_peroleh_tkd');
            $table->date('tanggal_peroleh');

            $table->tinyInteger('luas_ada_patok');
            $table->tinyInteger('luas_tidak_patok');
            $table->tinyInteger('luas_ada_papan_nama');
            $table->tinyInteger('luas_tidak_papan_nama');
            $table->string('lokasi');
            $table->string('manfaat');
            $table->string('mutasi');
            $table->string('keterangan');
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
        Schema::dropIfExists('tanah_kas_desa');
    }
}
