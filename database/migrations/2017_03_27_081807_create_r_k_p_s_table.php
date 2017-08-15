<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRKPSTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rkp', function(Blueprint $table) {
			$table->increments('id');
			$table->string('tahun', 4);
			$table->text('rencana_kegiatan')->nullable();
			$table->unsignedInteger('rpjm_id');
			$table->unsignedInteger('kegiatan_kerja_id');
			$table->timestamps();

			$table->foreign('rpjm_id')->references('id')->on('rpjm');
			$table->foreign('kegiatan_kerja_id')->references('id')->on('kegiatan_kerja');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rkp');
	}

}
