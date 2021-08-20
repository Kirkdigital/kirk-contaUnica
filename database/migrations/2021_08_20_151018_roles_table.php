<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class RolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create(config::get('database.connections.tenant.schema').'.roles', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name');
            //pessoa
			$table->boolean('add_people')->nullable()->default(1);
			$table->boolean('edit_people')->nullable()->default(1);
            $table->boolean('view_people')->nullable()->default(1);
            $table->boolean('delete_people')->nullable()->default(1);

            //grupo
			$table->boolean('add_group')->nullable()->default(1);
            $table->boolean('add_group_people')->nullable()->default(1);
            $table->boolean('edit_group')->nullable()->default(1);
            $table->boolean('view_group')->nullable()->default(1);
            $table->boolean('delete_group')->nullable()->default(1);

            //recado
			$table->boolean('add_message')->nullable()->default(1);
            $table->boolean('edit_message')->nullable()->default(1);
            $table->boolean('view_message')->nullable()->default(1);
            $table->boolean('delete_message')->nullable()->default(1);

            //financeiro
			$table->boolean('add_entrada_financial')->nullable()->default(1);
            $table->boolean('add_retirada_financial')->nullable()->default(1);
            $table->boolean('edit_financial')->nullable()->default(1);
            $table->boolean('view_financial')->nullable()->default(1);
            $table->boolean('delete_financial')->nullable()->default(1);

            //calendar
            $table->boolean('add_calendar')->nullable()->default(1);
            $table->boolean('edit_calendar')->nullable()->default(1);
            $table->boolean('view_calendar')->nullable()->default(1);
			$table->boolean('delete_calendar')->nullable()->default(1);

            //dash
            $table->boolean('view_periodo')->nullable()->default(1);
			$table->boolean('view_dash')->nullable()->default(1);
			$table->boolean('view_detail')->nullable()->default(1);
			$table->boolean('view_resumo_financeiro')->nullable()->default(1);

            //settings
            $table->boolean('settings_settings')->nullable()->default(1);
			$table->boolean('settings_email')->nullable()->default(1);
			$table->boolean('settings_meta')->nullable()->default(1);
			$table->boolean('settings_account')->nullable()->default(1);
            $table->boolean('settings_social')->nullable()->default(1);

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
		Schema::drop('roles');
	}
}
