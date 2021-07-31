<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationMoneyFormRequest;
use App\Models\Balance;
use App\Models\Status;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Historic;

class BalanceController extends Controller
{

    private $totalPagesPaginate = 12;

    public function index(Historic $historic)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        $historics = auth()->user()
                    ->historics()->with(['userSender'])->with('status')->with('statuspag') 
                    ->orderby('id','desc')
                    ->paginate(7);   
                    
        $types = $historic->type();  
        
        $balance = auth()->user()->balance;
        $amount = number_format($balance ? $balance->amount : 0, '2', ',', '.');

        //dd(auth()->user());
        //dd(auth()->user()->name);
        //dd(auth()->user()->balance);

        return view('balance.index',compact('amount', 'historics', 'types'));
    }

    public function depositar()
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        $peoples = People::all()->sortBy('name');
        $statuspag = Status::all()->where("type",'pagamento');
        $statusfinan = Status::all()->where("type",'financial')->where('class','entrada');

        return view('balance.depositar', ['peoples' => $peoples, 'statusfinan' => $statusfinan],compact('statuspag'));
    }
    
    //autocompleto pessoa
    public function dataAjax(Request $request)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        
        $data = People::all();
        if($request->has('q')){
            $search = $request->q;
            $data = People::select("id","name","email")
                    ->where('name','LIKE',"%$search%")
                    ->get();
        }
        return response()->json($data);
    }


    public function depositStore(ValidationMoneyFormRequest $request)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        //dd($request->all());
        //dd(auth()->user()->balance()->firstOrCreate([]));
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->valor, $request->pag, $request->date_lancamento, $request->observacao, $request->tipo, $request->itemName);

        if ($response['success']) {
            return redirect('financial')
                ->with('success', $response['message']);
        }

        return redirect()
            ->back()
            ->with('error', $response['message']);
    }

    public function withdraw()
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        $peoples = People::all()->sortBy('name');
        $statuspag = Status::all()->where("type",'pagamento');
        $statusfinan = Status::all()->where("type",'financial')->where('class','retira');

        return view('balance.withdraw', ['peoples' => $peoples, 'statusfinan' => $statusfinan],compact('statuspag'));

    }

    public function withdrawStore(ValidationMoneyFormRequest $request)
    {
        //dd($request->all());
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->valor, $request->pag, $request->date_lancamento, $request->observacao, $request->tipo, $request->itemName);

        if ($response['success']) {
            return redirect('financial')
                ->with('success', $response['message']);
        }

        return redirect()
            ->back()
            ->with('error', $response['message']);
    }

    public function transfer()
    {
        return view('balance.transfer');
    }

    public function confirmTransfer(Request $request, People $user)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        if (!$sender = $user->getSender($request->sender)) {
            return redirect()
                ->back()
                ->with('error', 'Usuário não encontrado!');
        }
        if ($sender->id === auth()->user()->id) {
            return redirect()
                ->back()
                ->with('error', 'Não é possivel transferir para você mesmo!');
        }

        $balance = auth()->user()->balance;

        return view('balance.transfer-confirm', compact('sender', 'balance'));

    }

    public function transferStore(ValidationMoneyFormRequest $request, People $user)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        if (!$sender = $user->find($request->sender_id))
            return redirect()
                ->route('balance.transfer')
                ->with('success', 'Recebedor não encontrado!');

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->valor, $sender);

        if ($response['success']) {
            return redirect('balance')
                ->with('success', $response['message']);
        }

        return redirect()
            ->route('balance.transfer')
            ->with('error', $response['message']);
    }

    public function historic(Historic $historic)
    {
        
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        $historics = auth()->user()
                    ->historics()->with(['userSender'])
                    ->orderby('id','desc')
                    ->paginate($this->totalPagesPaginate);   
                    
        $types = $historic->type();            
        $statuspag = Status::all()->where("type",'pagamento');
        $statusfinan = Status::all()->where("type",'financial');

        return view('balance.historics', compact('historics', 'types', 'statuspag', 'statusfinan'));
    }

    public function searchHistoric(Request $request, Historic $historic)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        $dataForm = $request->except('_token');

        $historics =  $historic->search($dataForm, $this->totalPagesPaginate);

        $types = $historic->type();

        $statuspag = Status::all()->where("type",'pagamento');
        $statusfinan = Status::all()->where("type",'financial');

        return view('balance.historics', compact('historics', 'types', 'dataForm', 'statuspag', 'statusfinan'));
    }

}