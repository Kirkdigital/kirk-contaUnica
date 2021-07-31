<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institution', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name_company');
			$table->bigInteger('integrador');
			$table->string('email')->nullable();
			$table->string('mobile')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->timestamps(10);
			$table->string('tenant')->nullable();
			$table->integer('status_id')->nullable();
			$table->softDeletes();
			$table->string('doc')->nullable();
			$table->string('cep')->nullable();
			$table->string('state')->nullable();
			$table->string('city')->nullable();
			$table->string('country')->nullable();
			$table->dateTime('expired')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('institution');
	}

}
