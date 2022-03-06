<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


class BalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('account_id');
			$table->float('amount', 10, 0)->default(0);
		});
    }
    public function down()
    {
        Schema::dropIfExists('balances');
    }
}
