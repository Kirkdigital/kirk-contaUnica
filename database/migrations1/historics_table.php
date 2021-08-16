<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class historicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historics', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('type');
			$table->float('amount', 10, 0);
			$table->float('total_before', 10, 0);
			$table->float('total_after', 10, 0);
			$table->integer('user_id_transaction')->nullable();
			$table->date('date');
			$table->timestamps(10);
			$table->string('tipo')->nullable();
			$table->string('observacao')->nullable();
			$table->string('pag')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('historics');
	}

}
