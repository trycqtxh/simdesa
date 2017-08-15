<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratMenyuratsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('surat_menyurat', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nomor_surat', 50)->unique();
			$table->string('jenis_surat', 100);
			$table->string('pemohon', 100);
			$table->string('url', 255);
			$table->date('tanggal_surat');
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
		Schema::drop('surat_menyurat');
	}

}
