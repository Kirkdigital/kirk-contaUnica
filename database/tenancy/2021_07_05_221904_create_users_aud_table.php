<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_aud', function(Blueprint $table)
		{
			$table->bigInteger('id')->nullable();
			$table->string('name')->nullable();
			$table->string('email')->nullable()->unique('users_copy1_email_key');
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password')->nullable();
			$table->string('menuroles')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps(10);
			$table->softDeletes();
			$table->string('mobile')->nullable();
			$table->bigInteger('license')->nullable();
			$table->string('doc')->nullable();
			$table->time('expire')->nullable();
			$table->boolean('theme_dark')->nullable()->default(1);
			$table->boolean('sidebar_minimal')->nullable()->default(1);
			$table->string('image')->nullable();
			$table->bigInteger('rev', true)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_aud');
	}

}
