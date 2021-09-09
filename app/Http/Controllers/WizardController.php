<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\People_Precadastro;
use App\Models\Institution;
use Illuminate\Support\Facades\DB;


class WizardController extends Controller
{
    use SoftDeletes;

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
    public function index()
    {
        $institutions = Institution::all()->where('deleted_at', '=', null);
        return view('account.wizardList', ['institutions' => $institutions]);
    }
    
    public function searchAccount(Request $request, Institution $institution)
    {
        $dataForm = $request->except('_token');
        $institutions =  $institution->search($dataForm, $this->totalPagesPaginate)->where('deleted_at', '=', null);
        return view('account.wizardList', compact('institutions', 'dataForm'));
    }
    public function create()
    {
        $institutions = Institution::all()->where('deleted_at', '=', null);
        return view('account.wizard', ['institutions' => $institutions]);
    }
    public function store(Request $request)
    {
        $you = auth()->user();

        //pegar tenant
        $value = $request->session()->get('key-wizard');
        Config::set('database.connections.tenant.schema', $value);
        //dump($value);
        //validar se tem
        $validarprecadastro = People_Precadastro::where('user_id', $you->id);
        if ($validarprecadastro->count() == 0)
        {     
        //inserir no banco correto
        $people = new People_Precadastro();
        $people->name          = strtoupper($request->input('name'));
        $people->email         = auth()->user()->email;
        $people->mobile        = $request->input('mobile');
        $people->birth_at      = $request->input('birth_at');
        $people->address       = $request->input('address');
        $people->city          = $request->input('city');
        $people->state          = $request->input('state');
        $people->cep           = $request->input('cep');
        $people->country       = $request->input('country');
        $people->status_id = '21';
        $people->role = '2';
        $people->sex       = $request->input('sex');
        $people->user_id = $you->id;
        $people->save();
        $this->adicionar_log('10', 'C', $people);
        
        $request->session()->flash("success", 'Cadastrado com sucesso, aguardar aprovação do administrador');
        return redirect()->route('account.index');
        }
        else{
           session()->flash("info", "Você já possuiu vinculo, aguarde um administrador aprovar o seu acesso.");
           return redirect()->route('account.index');
        }
    }
    public function tenantWizard(Request $request, $id)
    {
        //mater toda a sessao
        $request->session()->forget('key-wizard');
        //inserir o código
        $request->session()->put('key-wizard', $id);
        //retornar
        return redirect()->route('wizard.create');
    }
}
