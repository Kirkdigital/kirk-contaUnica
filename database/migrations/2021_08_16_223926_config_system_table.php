<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


class ConfigSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config::get('database.connections.tenant.schema').'.config_system', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->boolean('view_periodo')->nullable()->default(1);
			$table->boolean('view_dash')->nullable()->default(1);
			$table->boolean('view_detail')->nullable()->default(1);
			$table->boolean('view_resumo_financeiro')->nullable()->default(1);
			
			$table->boolean('delete_institution')->nullable()->default(1);
			$table->boolean('delete_people')->nullable()->default(1);
			$table->boolean('delete_note')->nullable()->default(1);
			$table->boolean('delete_group')->nullable()->default(1);
			$table->boolean('delete_financial')->nullable()->default(1);
			$table->boolean('delete_calendar')->nullable()->default(1);

			$table->boolean('add_people')->nullable()->default(1);
			$table->boolean('add_institution')->nullable()->default(1);
			$table->boolean('add_group')->nullable()->default(1);

			$table->boolean('edit_people')->nullable()->default(1);
			$table->boolean('edit_institution')->nullable()->default(1);
			$table->boolean('edit_group')->nullable();
			$table->timestamps(10);
			$table->integer('user_id')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('config_system');
    }
}
