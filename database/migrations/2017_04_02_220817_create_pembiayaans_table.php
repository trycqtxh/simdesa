<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembiayaansTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pembiayaan', function(Blueprint $table) {
            $table->increments('id');
			$table->string('uraian');
			$table->enum('level', ['level_1', 'level_2', 'level_3']);
			$table->integer('jumlah_dana', false, true)->nullable();
			$table->string('tahun', 4);
			$table->string('keterangan')->nullable();
			$table->unsignedInteger('bidang_id')->nullable();
			$table->unsignedInteger('pembiayaan_id')->nullable();
            $table->timestamps();

			$table->foreign('pembiayaan_id')->references('id')->on('pembiayaan');
			$table->foreign('bidang_id')->references('id')->on('bidang');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pembiayaan');
	}

}
