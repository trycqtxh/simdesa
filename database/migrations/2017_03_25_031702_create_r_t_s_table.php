<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRTSTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_ts', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nama', 50);
			$table->string('petugas', 50);
			$table->unsignedInteger('rw_id');
			$table->timestamps();

			$table->foreign('rw_id')->references('id')->on('r_ws');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('r_ts');
	}

}
