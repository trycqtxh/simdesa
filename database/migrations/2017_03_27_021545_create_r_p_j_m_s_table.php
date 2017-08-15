<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRPJMSTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rpjm', function(Blueprint $table) {
			$table->increments('id');
			$table->string('periode', 12)->unique();
			$table->string('tahun_awal', 4);
			$table->string('tahun_akhir', 4);
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
		Schema::drop('rpjm');
	}

}
