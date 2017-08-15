<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendudukInduksTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penduduk_induk', function(Blueprint $table) {
            $table->string('nik', 16);
			$table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable();
			$table->enum('agama', ['ISLAM', 'KRISTEN PROTESTAN', 'KRISTEN KATOLIK', 'HINDU', 'BUDDHA', 'KONGHUCU'])->nullable();
			$table->enum('status_perkawinan', ['BK', 'K', 'JD', 'DD'])->comment('BK: BELUM KAWIN; K: KAWIN; JD: JANDA; DD:DUDA');
			$table->enum('pendidikan', ['Tidak/Belum Sekolah', 'SD', 'SMP', 'SMA', 'DIPLOMA I (D1)', 'DIPLOMA II (D2)', 'DIPLOMA III (D3)', 'STRATA I (S1)', 'STRATA II (S2)', 'STRATA III (S3)'])->nullable();

			$table->text('alamat')->nullable();
			$table->string('keterangan', 255)->nullable();

			$table->string('nomor_kk', 16)->nullable();
			$table->unsignedInteger('status_keluarga_id')->nullable();
			$table->enum('membaca', ['L', 'D', 'A', 'AL', 'AD', 'ALD'])->comment('L: Latin; D: Daerah; A: Arab; AL: Arab Latin; AD: Arab Daerah; ALD: Arab Latin Daerah')->nullable();
			$table->string('dusun', 100);
			//$table->date('tanggal_tinggal')->nullable();
			$table->unsignedInteger('rw_id');
			$table->unsignedInteger('rt_id');
			$table->unsignedInteger('penduduk_id');
			$table->unsignedInteger('pekerjaan_id')->nullable();

			$table->string('ayah', 50)->nullable();
			$table->string('ibu', 50)->nullable();
			$table->string('nik_ayah', 16)->nullable();
			$table->string('nik_ibu', 16)->nullable();

			$table->timestamps();
//			$table->softDeletes();
			$table->primary('nik');

			$table->foreign('pekerjaan_id')->references('id')->on('pekerjaan');
			$table->foreign('status_keluarga_id')->references('id')->on('status_keluarga')->onDelete('cascade');
			$table->foreign('penduduk_id')->references('id')->on('penduduk');
			$table->foreign('nomor_kk')->references('nomor_kk')->on('anggota_keluarga');
			$table->foreign('rt_id')->references('id')->on('r_ts');
			$table->foreign('rw_id')->references('id')->on('r_ws');

			$table->foreign('nik_ayah')->references('nik')->on('penduduk_induk')->onDelete('cascade');
			$table->foreign('nik_ibu')->references('nik')->on('penduduk_induk')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('penduduk_induk');
	}

}
