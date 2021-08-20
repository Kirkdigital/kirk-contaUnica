<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


class ConfigEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config::get('database.connections.tenant.schema').'.config_email', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('email_from');
			$table->string('smtp_host');
			$table->integer('smtp_port');
			$table->string('smtp_user');
			$table->string('smtp_pass');
            $table->integer('smtp_security')->nullable();
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
        Schema::drop('config_email');
    }
}