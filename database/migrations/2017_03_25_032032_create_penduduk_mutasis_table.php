<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendudukMutasisTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penduduk_mutasi', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nik', 16)->unique();
			$table->date('tanggal');
			$table->enum('jenis', ['MASUK', 'KELUAR', 'MATI']);
			$table->string('daerah', 100);
			$table->string('keterangan', 255)->nullable();
			$table->unsignedInteger('penduduk_id');
			$table->timestamps();

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
		Schema::drop('penduduk_mutasi');
	}

}
