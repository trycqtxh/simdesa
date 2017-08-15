<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLembarBeritaDesasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lembar_berita_desa', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nomor_diundangkan', 20);
			$table->date('tanggal_diundangkan');
            $table->string('keterangan',100);
			$table->unsignedInteger('peraturan_id')->unique();
            $table->timestamps();

			$table->foreign('peraturan_id')->references('id')->on('peraturan_desa');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lembar_berita_desa');
	}

}
