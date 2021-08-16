<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class groupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name_group');
			$table->bigInteger('user_id')->nullable();
			$table->string('type', 64)->nullable();
			$table->date('deleted_at')->nullable();
			$table->bigInteger('status_id')->nullable();
			$table->date('created_at')->nullable();
			$table->string('note')->nullable();
			$table->date('updated_at')->nullable();
			$table->smallInteger('count')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}

}
