<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejaNazarenoManaus2configMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('igreja_nazareno_manaus_2.config_meta', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('visitante_mes')->nullable()->default(0);
			$table->integer('batismo_mes')->nullable()->default(0);
			$table->integer('conversao_mes')->nullable()->default(0);
			$table->integer('pessoa_mes')->nullable()->default(0);
			$table->integer('visualizacao_mes')->nullable()->default(0);
			$table->integer('comentario_mes')->nullable()->default(0);
			$table->integer('grupo_ativo_ano')->nullable()->default(0);
			$table->integer('visitante_ano')->nullable()->default(0);
			$table->integer('batismo_ano')->nullable()->default(0);
			$table->integer('conversao_ano')->nullable()->default(0);
			$table->integer('pessoa_ano')->nullable()->default(0);
			$table->integer('visualizacao_ano')->nullable()->default(0);
			$table->integer('comentario_ano')->nullable()->default(0);
			$table->integer('grupo_ativo_mes')->nullable()->default(0);
			$table->dateTime('updated_at')->nullable();
			$table->integer('publicacao_ano')->nullable()->default(0);
			$table->integer('publicacao_mes')->nullable()->default(0);
			$table->date('ano')->nullable();
			$table->decimal('fin_dizimo_mes', 10, 0)->nullable();
			$table->decimal('fin_oferta_mes', 10, 0)->nullable();
			$table->decimal('fin_despesa_mes', 10, 0)->nullable();
			$table->decimal('fin_acao_mes', 10, 0)->nullable();
			$table->decimal('fin_dizimo_ano', 10, 0)->nullable();
			$table->decimal('fin_oferta_ano', 10, 0)->nullable();
			$table->decimal('fin_acao_ano', 10, 0)->nullable();
			$table->decimal('fin_despesa_ano', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('igreja_nazareno_manaus_2.config_meta');
	}

}
