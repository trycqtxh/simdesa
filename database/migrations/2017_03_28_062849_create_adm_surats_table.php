<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmSuratsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adm_surat', function(Blueprint $table) {
            $table->increments('id');
			$table->date('tanggal_pengirim_penerima');
			$table->string('nomor_surat', 20);
			$table->date('tanggal_surat');
			$table->string('pengirim_penerima');
			$table->string('isi_surat');
			$table->string('keterangan');
			$table->enum('jenis', ['masuk', 'keluar', 'ekspedisi']);
			$table->unsignedInteger('penanggung_jawab_id');
            $table->timestamps();

			$table->foreign('penanggung_jawab_id')->references('id')->on('aparat_desa');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adm_surat');
	}

}
