<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTanahDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanah_desa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->tinyInteger('jumlah');
            $table->enum('status_tanah', ['hm', 'hgb', 'hp', 'hgu', 'hpl', 'ma', 'vi', 'tn']);//tanah kas menjadi tn
            $table->tinyInteger('luas_status');
            $table->enum('penggunaan_tanah', ['Sawah', 'Tegalan', 'Kebun', 'Ternak / Tambak / Kolam', 'Tanah Kering / Darat', 'Hutan Belukar', 'Hutan Lebat / Lindung', 'Mutasi Tanah Di Desa', 'Tanah Kosong', 'Perumahan', 'Perdagangan dan Jasa', 'Perkantoran', 'Industri', 'Fasilitas Umum', 'lain-lain']);
            $table->tinyInteger('luas_penggunaan');
            $table->string('keterangan');
            $table->unsignedInteger('id_tanah_kas_desa')->nullable();
            $table->timestamps();

            $table->foreign('id_tanah_kas_desa')->references('id')->on('tanah_kas_desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanah_desa');
    }
}
