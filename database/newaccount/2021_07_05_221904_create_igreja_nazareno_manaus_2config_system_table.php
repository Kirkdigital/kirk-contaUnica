<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejaNazarenoManaus2configSystemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('igreja_nazareno_manaus_2.config_system', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->boolean('delete_institution')->nullable();
			$table->boolean('delete_people')->nullable();
			$table->boolean('delete_note')->nullable();
			$table->boolean('delete_group')->nullable();
			$table->boolean('delete_financial')->nullable();
			$table->boolean('delete_calendar')->nullable();
			$table->boolean('view_periodo')->nullable();
			$table->boolean('view_dash')->nullable();
			$table->boolean('view_detail')->nullable();
			$table->boolean('add_people')->nullable();
			$table->boolean('add_institution')->nullable();
			$table->boolean('add_group')->nullable();
			$table->boolean('edit_people')->nullable();
			$table->date('updated_at')->nullable();
			$table->boolean('edit_institution')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('igreja_nazareno_manaus_2.config_system');
	}

}
