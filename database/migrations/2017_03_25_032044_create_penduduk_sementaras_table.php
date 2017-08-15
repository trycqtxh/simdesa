<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendudukSementarasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penduduk_sementara', function(Blueprint $table) {
            $table->increments('id');
			$table->string('no_identitas', 16);
			$table->enum('tipe_identitas', ['KTP', 'PASPORT']);

			$table->string('tujuan', 255);
			$table->string('alamat_tujuan', 255);
			$table->string('daerah_asal', 100);
			$table->string('turunan', 255)->nullable();
			$table->date('tanggal_datang');
			$table->date('tanggal_pergi')->nullable();
			$table->string('keterangan', 255)->nullable();
			$table->unsignedInteger('pekerjaan_id')->nullable();
			$table->unsignedInteger('penduduk_id');
            $table->timestamps();

			$table->foreign('pekerjaan_id')->references('id')->on('pekerjaan');
			$table->foreign('penduduk_id')->references('id')->on('penduduk');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('penduduk_sementara');
	}

}
