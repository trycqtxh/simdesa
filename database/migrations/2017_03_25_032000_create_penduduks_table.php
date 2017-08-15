<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenduduksTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penduduk', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nama', 100);
			$table->string('tempat_lahir', 100);
			$table->date('tanggal_lahir');
			$table->enum('jenis_kelamin', ['L', 'P'])->comment('L: LAKI-LAKI; P:PEREMPUAN;');
			$table->enum('kewarga_negaraan', ['WNI', 'WNA']);

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
		Schema::drop('penduduk');
	}

}
