<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKTPSTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ktp', function(Blueprint $table) {
            $table->increments('id');
			$table->date('tanggal_mulai_di_desa')->nullable();
			$table->date('tanggal_dikeluarkan')->nullable();
			$table->string('tempat_dikeluarkan')->nullable();
			$table->string('keterangan')->nullable();
			$table->string('nik', 16)->unique();
            $table->timestamps();

			$table->foreign('nik')->references('nik')->on('penduduk_induk')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ktp');
	}

}
