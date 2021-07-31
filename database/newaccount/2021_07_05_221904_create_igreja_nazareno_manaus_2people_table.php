<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejaNazarenoManaus2peopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('igreja_nazareno_manaus_2.people', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->string('mobile')->nullable();
			$table->date('birth_at')->nullable();
			$table->string('address')->nullable();
			$table->string('country')->nullable();
			$table->string('state')->nullable();
			$table->string('city')->nullable();
			$table->string('role')->nullable();
			$table->boolean('is_active')->nullable()->default(1);
			$table->boolean('is_verify')->nullable();
			$table->boolean('is_visitor')->nullable();
			$table->boolean('is_transferred')->nullable();
			$table->boolean('is_responsible')->nullable();
			$table->boolean('is_conversion')->nullable();
			$table->boolean('is_baptism')->nullable();
			$table->boolean('is_newvisitor')->nullable();
			$table->string('note')->nullable();
			$table->string('username')->nullable();
			$table->string('password')->nullable();
			$table->timestamps(10);
			$table->softDeletes();
			$table->integer('status_id')->nullable();
			$table->string('cep', 10)->nullable();
			$table->string('sex', 1)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('igreja_nazareno_manaus_2.people');
	}

}
