<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAparatDesasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aparat_desa', function(Blueprint $table) {
            $table->increments('id');
			$table->string('niap', 20)->unique()->nullable();
			$table->string('nip', 20)->unique()->nullable();
			$table->enum('golongan', ['I/a', 'I/b', 'I/c', 'I/d', 'II/a', 'II/b', 'II/c', 'II/d', 'III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'IV/b', 'IV/c', 'IV/d'])->nullable();
			$table->string('no_pengangkatan', 20)->nullable();
			$table->date('tanggal_pengangkatan')->nullable();
			$table->string('no_pemberhentian')->nullable();
			$table->date('tanggal_pemberhentian', 20)->nullable();
			$table->string('keterangan', 255)->nullable();

			$table->unsignedInteger('jabatan_id')->nullable();
			$table->string('nik_penduduk', 16)->nullable();
			$table->boolean('admin')->default(false);
			$table->string('password');
			$table->rememberToken();
            $table->timestamps();

			$table->foreign('jabatan_id')->references('id')->on('jabatan');
			$table->foreign('nik_penduduk')->references('nik')->on('penduduk_induk')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aparat_desa');
	}

}
