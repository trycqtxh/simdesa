<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggotaKeluargasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anggota_keluarga', function(Blueprint $table) {
			$table->string('nomor_kk', 16)->primary();
			$table->date('tanggal_mulai_di_desa')->nullable();
			$table->date('tanggal_dikeluarkan')->nullable();
			$table->string('tempat_dikeluarkan')->nullable();
			$table->string('keterangan')->nullable();
            $table->timestamps();

//			$table->foreign('rt_id')->references('id')->on('r_ts');
//			$table->foreign('rw_id')->references('id')->on('r_ws');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('anggota_keluarga');
	}

}
