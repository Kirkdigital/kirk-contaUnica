<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejaNazarenoManaus2formFieldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('igreja_nazareno_manaus_2.form_field', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->timestamps(10);
			$table->string('name');
			$table->string('type');
			$table->boolean('browse');
			$table->boolean('read');
			$table->boolean('edit');
			$table->boolean('add');
			$table->string('relation_table')->nullable();
			$table->string('relation_column')->nullable();
			$table->integer('form_id');
			$table->string('column_name');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('igreja_nazareno_manaus_2.form_field');
	}

}
