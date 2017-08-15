<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeraturanDesasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('peraturan_desa', function(Blueprint $table) {
            $table->increments('id');
			$table->enum('jenis_peraturan', ['Peraturan Desa', 'Peraturan Kepala Desa']);
			$table->string('nomor_ditetapkan', 20);
			$table->date('tanggal_ditetapkan');
			$table->string('tentang', 255);
			$table->text('uraian');
			$table->string('nomor_kesepakatan', 20)->nullable();
			$table->date('tanggal_kesepakatan')->nullable();
			$table->string('nomor_laporan', 20);
			$table->date('tanggal_laporan');
			$table->string('keterangan',100);
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
		Schema::drop('peraturan_desa');
	}

}
