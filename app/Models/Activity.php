<?php

namespace App\Models;

use App\Models\People;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Activity extends Model
{
    public $timestamps = false;
    protected $connection = 'tenant';

    public function deposit($valor, $pag, $date_lancamento, $observacao, $tipo, $people, $you): array
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        DB::beginTransaction();
        //dd($valor)
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($valor, 2, '.', '');
        $deposit = $this->save();

        $historic = Historic::create([
            'type' => 'I',
            'amount' => $valor,
            'tipo' => $tipo,
            'date' => date($date_lancamento),
            'observacao' => $observacao,
            'pag' => $pag,
            'total_before' => $totalBefore,
            'user_id_transaction' => $people,
            'total_after' => $this->amount,
            'user_id' => auth()->user()->id
        ]);

        if ($deposit && $historic) {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Depositado com sucesso!',
            ];

        } else {

            DB::rollback();

            return [
                'success' => false,
                'message' => 'Ocorreu um erro!',
            ];

        }
    }

    public function withdraw(float $valor, $pag, $date_lancamento, $observacao, $tipo): array
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        if ($this->amount < $valor) {
            return [
                'success' => false,
                'message' => 'Seu saldo é insuficiente para efetuar saque',
            ];
        }

        DB::beginTransaction();
        //dd($valor);
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($valor, 2, '.', '');
        $withdraw = $this->save();

        $historic = Historic::create([
            'type' => 'O',
            'amount' => $valor,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date($date_lancamento),
            'tipo' => $tipo,
            'observacao' => $observacao,
            'pag' => $pag,
            'total_before' => $totalBefore,
            'user_id' => auth()->user()->id
        ]);

        if ($withdraw && $historic) {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Saque efetuado com sucesso!',
            ];

        } else {

            DB::rollback();

            return [
                'success' => false,
                'message' => 'Ocorreu um erro na tentativa de saque!',
            ];

        }
    }

}