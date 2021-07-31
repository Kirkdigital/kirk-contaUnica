<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejaNazarenoManaus2mediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('igreja_nazareno_manaus_2.media', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('model_type');
			$table->bigInteger('model_id');
			$table->string('collection_name');
			$table->string('name');
			$table->string('file_name');
			$table->string('mime_type')->nullable();
			$table->string('disk');
			$table->string('conversions_disk');
			$table->bigInteger('size');
			$table->bigInteger('uuid');
			$table->text('manipulations');
			$table->text('custom_properties');
			$table->text('responsive_images');
			$table->integer('order_column')->nullable();
			$table->timestamps(10);
			$table->index(['model_type','model_id'], 'media_model_type_model_id_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('igreja_nazareno_manaus_2.media');
	}

}
