<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


class peopleGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people_group', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('user_id');
			$table->bigInteger('group_id');
			$table->bigInteger('responsavel')->nullable();
			$table->dateTime('registered')->nullable();
		});
	}
	public function down()
    {
        Schema::dropIfExists('people_group');
    }
}
