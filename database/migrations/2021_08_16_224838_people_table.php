<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class peopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->string('mobile')->nullable();
			$table->date('birth_at')->nullable();
            $table->string('sex', 1)->nullable();
			$table->string('address')->nullable();
            $table->string('cep', 10)->nullable();
			$table->string('country')->nullable();
			$table->string('state')->nullable();
			$table->string('city')->nullable();
            $table->string('role')->nullable();
			$table->string('note')->nullable();
            $table->integer('status_id');
			$table->boolean('is_active')->nullable()->default(1);
			$table->boolean('is_verify')->nullable()->default(1);
			$table->boolean('is_visitor')->nullable()->default(0);
			$table->boolean('is_transferred')->nullable()->default(0);
			$table->boolean('is_responsible')->nullable()->default(0);
			$table->boolean('is_conversion')->nullable()->default(0);
			$table->boolean('is_baptism')->nullable()->default(0);
			$table->boolean('is_newvisitor')->nullable()->default(0);
			$table->integer('user_id')->nullable();
            $table->timestamps(10);
			$table->softDeletes('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('people');
	}

}
