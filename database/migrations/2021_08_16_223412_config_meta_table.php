<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class ConfigMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('config_meta', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
            $table->string('ano')->nullable();
			$table->integer('fin_dizimo_mes')->nullable()->default(0);
			$table->integer('fin_oferta_mes')->nullable()->default(0);
			$table->integer('fin_despesa_mes')->nullable()->default(0);
			$table->integer('fin_acao_mes')->nullable()->default(0);

			$table->integer('fin_dizimo_ano')->nullable()->default(0);
			$table->integer('fin_oferta_ano')->nullable()->default(0);
			$table->integer('fin_despesa_ano')->nullable()->default(0);
            $table->integer('fin_acao_ano')->nullable()->default(0);

			$table->integer('visitante_mes')->nullable()->default(0);
			$table->integer('batismo_mes')->nullable()->default(0);
			$table->integer('conversao_mes')->nullable()->default(0);
			$table->integer('pessoa_mes')->nullable()->default(0);
			$table->integer('visualizacao_mes')->nullable()->default(0);
			$table->integer('comentario_mes')->nullable()->default(0);
			$table->integer('grupo_ativo_mes')->nullable()->default(0);
			$table->integer('publicacao_mes')->nullable()->default(0);

			$table->integer('visitante_ano')->nullable()->default(0);
			$table->integer('batismo_ano')->nullable()->default(0);
			$table->integer('conversao_ano')->nullable()->default(0);
			$table->integer('pessoa_ano')->nullable()->default(0);
			$table->integer('visualizacao_ano')->nullable()->default(0);
			$table->integer('comentario_ano')->nullable()->default(0);
            $table->integer('grupo_ativo_ano')->nullable()->default(0);
			$table->integer('publicacao_ano')->nullable()->default(0);
			$table->timestamps(10);
		});
		
	}
	public function down()
    {
        Schema::dropIfExists('config_meta');
    }
}
