<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejaNazarenoManaus2emailTemplateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('igreja_nazareno_manaus_2.email_template', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->timestamps(10);
			$table->text('content');
			$table->string('name');
			$table->string('subject');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('igreja_nazareno_manaus_2.email_template');
	}

}
