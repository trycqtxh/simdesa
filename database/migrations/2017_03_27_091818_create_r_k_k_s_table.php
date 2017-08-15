<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRKKSTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rkk', function(Blueprint $table) {
            $table->increments('id');

			$table->tinyInteger('sasaran_laki_laki');
			$table->tinyInteger('sasaran_perempuan');
			$table->tinyInteger('sasaran_a_rtm');
			$table->date('mulai');
			$table->date('selesai');

			$table->unsignedInteger('rkp_id');
			$table->unsignedInteger('detail_kegiatan_kerja_id');
            $table->timestamps();

			$table->foreign('detail_kegiatan_kerja_id')->references('id')->on('detail_kegiatan_kerja');
			$table->foreign('rkp_id')->references('id')->on('rkp');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rkk');
	}

}
