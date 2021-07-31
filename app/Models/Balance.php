<?php

namespace App\Models;

use App\Models\People;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Balance extends Model
{
    public $timestamps = false;
    protected $connection = 'tenant';

    public function deposit($valor, $pag, $date_lancamento, $observacao, $tipo, $people): array
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        DB::beginTransaction();
        //dd($valor)
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($valor, 2, '.', '');
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $valor,
            'tipo' => $tipo,
            'date' => date($date_lancamento),
            'observacao' => $observacao,
            'pag' => $pag,
            'total_before' => $totalBefore,
            'user_id_transaction' => $people,
            'total_after' => $this->amount,
 
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

        $historic = auth()->user()->historics()->create([
            'type' => 'O',
            'amount' => $valor,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date($date_lancamento),
            'tipo' => $tipo,
            'observacao' => $observacao,
            'pag' => $pag,
            'total_before' => $totalBefore,
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

    public function transfer(float $valor, People $sender): array
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        if ($this->amount < $valor) {
            return [
                'success' => false,
                'message' => 'Seu saldo é insuficiente para efetuar saque',
            ];
        }

        DB::beginTransaction();

        /*
         * Primeiro atualiza o próprio saldo
         */
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($valor, 2, '.', '');
        $transfer = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'T',
            'amount' => $valor,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => $sender->id,
        ]);

        /*
         * Segundo, atualiza o saldo do recebedor da transferência
         */
        $senderBalance = $sender->balance()->firstOrCreate([]);
        $totalBeforeSender = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount += number_format($valor, 2, '.', '');
        $transferSender = $senderBalance->save();

        $historicSender = $sender->historics()->create([
            'type' => 'I',
            'amount' => $valor,
            'total_before' => $totalBeforeSender,
            'total_after' => $senderBalance->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => auth()->user()->id,
        ]);

        if ($transfer && $historic && $transferSender && $historicSender) {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Transferido com sucesso!',
            ];

        }

        DB::rollback();

        return [
            'success' => false,
            'message' => 'Não foi possivel transferir!',
        ];

    }

}