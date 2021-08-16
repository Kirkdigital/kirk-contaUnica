<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\People;
use App\Models\Institution;

class WizardController extends Controller
{

    private $totalPagesPaginate = 12;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $institutions = Institution::all();
        return view('account.wizard', ['institutions' => $institutions]);
    }
    
    public function searchAccount(Request $request, Institution $institution)
    {
        $dataForm = $request->except('_token');
        $institutions =  $institution->search($dataForm, $this->totalPagesPaginate);
        return view('account.wizard', compact('institutions', 'dataForm'));
    }

    public function store(Request $request)
    {
        $you = auth()->user();

        //pegar tenant
        $value = $request->session()->get('key');
        Config::set('database.connections.tenant.schema', $value);
       
        //validar se tem
        $validarprecadastro = People::where('user_id', $you->id);

        if ($validarprecadastro->count() == 0)
        {     
        //inserir no banco correto
        $people = new People();
        $people->name          = strtoupper($request->input('name'));
        $people->email         = auth()->user()->email;
        $people->mobile        = $request->input('mobile');
        $people->birth_at      = $request->input('birth_at');
        $people->address       = $request->input('address');
        $people->city          = $request->input('city');
        $people->state          = $request->input('state');
        $people->cep           = $request->input('cep');
        $people->country       = $request->input('country');
        $people->status_id = '14';
        $people->is_verify       = 'false';
        $people->sex       = $request->input('sex');
        $people->note       = 'PRECADASTRO';
        $people->user_id = $you->id;
        $people->save();
        $request->session()->flash("success", 'Cadastrado com sucesso, aguardar aprovação do administrador');
        return redirect()->route('account.index');
        }
        else{
            session()->flash("info", "Você já possuiu vinculo, aguarde um administrador aprovar o seu acesso.");
            return redirect()->route('account.index');
        }
    }
}
