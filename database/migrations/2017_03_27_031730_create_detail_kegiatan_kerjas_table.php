<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailKegiatanKerjasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail_kegiatan_kerja', function(Blueprint $table) {
            $table->increments('id');
			$table->string('lokasi', 255)->nullable();
			$table->string('volume', 255)->nullable();
			$table->string('manfaat', 255)->nullable();
			$table->integer('jumlah_dana', false, true)->nullable();
			$table->enum('pola_pelaksanaan', ['SWAKELOLA', 'KERJASAMA ANTAR DESA', 'KERJASAMA PIHAK 3'])->nullable();
			$table->string('keterangan')->nullable();
			$table->unsignedInteger('sumber_dana_id')->nullable();
			$table->unsignedInteger('kegiatan_kerja_id');

            $table->timestamps();

			$table->foreign('kegiatan_kerja_id')->references('id')->on('kegiatan_kerja');
			$table->foreign('sumber_dana_id')->references('id')->on('sumber_dana');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detail_kegiatan_kerja');
	}

}
