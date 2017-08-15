<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidangsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bidang', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nama', 100);
			$table->enum('jenis', ['pendapatan', 'belanja', 'pembiayaan']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bidang');
	}

}
