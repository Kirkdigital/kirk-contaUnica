<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejaNazarenoManaus2notesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('igreja_nazareno_manaus_2.notes', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('title');
			$table->text('content');
			$table->string('note_type');
			$table->date('applies_to_date');
			$table->integer('users_id');
			$table->integer('status_id');
			$table->timestamps(10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('igreja_nazareno_manaus_2.notes');
	}

}
