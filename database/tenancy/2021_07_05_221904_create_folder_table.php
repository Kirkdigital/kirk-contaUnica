<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('folder', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->timestamps(10);
			$table->string('name');
			$table->integer('folder_id')->nullable();
			$table->boolean('resource')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('folder');
	}

}
