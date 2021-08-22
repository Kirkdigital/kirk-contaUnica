<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


class ActivityStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_status', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('description');
			$table->string('type')->nullable();
			$table->timestamps(10);
		});
    }
}