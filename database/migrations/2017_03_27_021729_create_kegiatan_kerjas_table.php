<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanKerjasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kegiatan_kerja', function(Blueprint $table) {
			$table->increments('id');
			$table->string('uraian', 255);
			$table->enum('jenis', ['level_1', 'level_2', 'level_3'])->comment('level_1: sub-bidang; level_2: kegiatan; level_3: sub-kegiatan/rincian kegiatan');

//			$table->string('lokasi', 255)->nullable();
//			$table->string('volume', 255)->nullable();
//			$table->string('manfaat', 255)->nullable();
//			$table->integer('jumlah_dana', false, true)->nullable();
//			$table->unsignedInteger('sumber_dana_id')->nullable();
//			$table->enum('pola_pelaksanaan', ['SWAKELOLA', 'KERJASAMA ANTAR DESA', 'KERJASAMA PIHAK 3'])->nullable();

			$table->unsignedInteger('bidang_id')->nullable();
			$table->unsignedInteger('rpjm_id');
			$table->unsignedInteger('kegiatan_kerja_id')->nullable();
			$table->timestamps();

			$table->foreign('bidang_id')->references('id')->on('bidang');
			$table->foreign('rpjm_id')->references('id')->on('rpjm');
			$table->foreign('kegiatan_kerja_id')->references('id')->on('kegiatan_kerja');
//			$table->foreign('sumber_dana_id')->references('id')->on('sumber_dana');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kegiatan_kerja');
	}

}
