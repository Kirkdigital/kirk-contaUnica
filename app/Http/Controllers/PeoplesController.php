<?php

namespace App\Http\Controllers;

use App\Models\Config_system;
use Validator;
use DB;
use Hash;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\People;
use App\Models\People_Groups;
use App\Models\Roles;
use App\Models\Users_Account;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class PeoplesController extends Controller
{
    private $totalPagesPaginate = 10;
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
    public function index(People $people)
    {
        $you = auth()->user();
        //validar se selecionou a conta
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);
        //buscar
        $peoples = People::orderBy('name', 'asc')->with('status')->with('roleslocal')->paginate($this->totalPagesPaginate);
        //permissao
        $roles = People::where('user_id', $you->id)->with('roleslocal')->first();
        //status
        $statuses = Status::all()->where("type", 'people');

        return view('people.index', compact('peoples', 'roles', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pegar o tenant
        $this->pegar_tenant();
        //status
        $statuses = Status::all()->where("type", 'people');
        //campos obrigatório
        $campo = Config_system::find('1')->first();
        //roles 
        $roles = Roles::all();

        return view('people.createForm', compact('campo'), ['statuses' => $statuses, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->all([
            'name'             => 'required|min:1|max:255',
            'email'           => 'required',
            'mobile'         => 'required',
            'country'         => 'required',
            'status_id'         => 'required'
        ]);

        $people = new People();
        $nome = ($request->input('name') . ' ' . $request->input('last_name'));
        $people->name          = $nome;
        $people->email         = $request->input('email');
        $people->mobile        = $request->input('mobile');
        $people->birth_at      = $request->input('birth_at');
        $people->address       = $request->input('address');
        $people->city          = $request->input('city');
        $people->state          = $request->input('state');
        $people->cep           = $request->input('cep');
        $people->country       = $request->input('country');
        $people->role       = $request->input('role');
        $people->status_id = $request->input('status_id');
        $people->is_visitor       = $request->input('is_visitor');
        $people->is_transferred       = $request->input('is_transferred');
        $people->is_responsible       = $request->input('is_responsible');
        $people->is_conversion       = $request->input('is_conversion');
        $people->is_baptism       = $request->input('is_baptism');
        $people->is_verify       = 'true';
        $people->sex       = $request->input('sex');
        $people->note       = $request->input('note');
        $people->is_newvisitor = 'false';
        $this->pegar_tenant();
        $people->save();
        //consulta para criar o acesso a conta
        $validaruser = User::where('email', $people->email)->get();
        $criaracesso = $request->has('criar_acesso') ? 1 : 0;
        //criar a conta
        if ($criaracesso == true) {

            if ($validaruser->first() == null) {
                //criar o usuario
                $user =  User::create([
                    'name' => $people->name,
                    'email' => $people->email,
                    'password' => Hash::make(\Illuminate\Support\Str::random(8)),
                    'country' =>  $people->country,
                    'mobile' => $people->mobile
                ]);
                $user->assignRole('user');

                $this->adicionar_log_global('14', 'C', $user);

                $validaruser = User::where('email', $people->email)->get();
                $associar = People::where('email', $people->email)->first();
                $associar->user_id = $validaruser->first()->id;
                $associar->save();

                $this->criar($validaruser->first()->id, session()->get('key'));

                $request->session()->flash("success", "Successfully created people");
                return redirect()->route('people.index');
            } else {
                //associar ao usuario
                $associar = People::where('email', $people->email)->first();
                $associar->user_id = $validaruser->first()->id;
                $associar->save();

                $this->criar($validaruser->first()->id, session()->get('key'));
                $request->session()->flash("success", "Successfully created people");
                return redirect()->route('people.index');
            }
        } else {
            //se estiver desmarcado o criar conta, apenas adiciona a pessoa
            $this->adicionar_log('1', 'C', $people);
            $request->session()->flash("success", "Successfully created people");
            return redirect()->route('people.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //pegar tenant
        $this->pegar_tenant();
        //buscar pessoa
        $people = People::with('acesso')->find($id);
        //campo obrigatoria
        $campo = Config_system::find('1')->first();
        //status
        $statuses = Status::all()->where("type", 'people');
        //roles 
        $roles = Roles::all();

        return view('people.EditForm', compact('campo'), ['statuses' => $statuses, 'people' => $people, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'             => 'required|min:1|max:255',
            'email'           => 'required',
            'mobile'         => 'required',
            'status_id'         => 'required',
            'country'         => 'required'

        ]);
        $this->pegar_tenant();
        $people = People::find($id);
        $people->name          = strtoupper($request->input('name'));
        $people->email         = $request->input('email');
        $people->mobile        = $request->input('mobile');
        $people->birth_at      = $request->input('birth_at');
        $people->address       = $request->input('address');
        $people->city          = $request->input('city');
        $people->state          = $request->input('state');
        $people->cep           = $request->input('cep');
        $people->country       = $request->input('country');
        $people->role       = $request->input('role');
        $people->status_id = $request->input('status_id');
        $people->is_verify       = 'true';
        $people->is_visitor       = $request->has('is_visitor') ? 1 : 0;
        $people->is_transferred       = $request->has('is_transferred') ? 1 : 0;
        $people->is_responsible       = $request->has('is_responsible') ? 1 : 0;
        $people->is_conversion       = $request->has('is_conversion') ? 1 : 0;
        $people->is_baptism       = $request->has('is_baptism') ? 1 : 0;
        $people->sex       = $request->input('sex');
        $people->note       = $request->input('note');
        $people->is_newvisitor = 'false';
        $people->save();

        //consulta para criar o acesso a conta
        $validaruser = User::where('email', $people->email)->get();
        $criaracesso = $request->has('criar_acesso') ? 1 : 0;
        //criar a conta
        if ($criaracesso == true) {
            if ($validaruser->first() == null) {
                //criar o usuario
                $user =  User::create([
                    'name' => $people->name,
                    'email' => $people->email,
                    'password' => Hash::make(\Illuminate\Support\Str::random(8)),
                    'country' =>  $people->country,
                    'mobile' => $people->mobile
                ]);
                $user->assignRole('user');
                //logs
                $this->adicionar_log_global('14', 'C', $user);
                $this->adicionar_log('1', 'U', $people);
                //validar email
                $validaruser = User::where('email', $people->email)->get();
                $associar = People::where('email', $people->email)->first();
                $associar->user_id = $validaruser->first()->id;
                $associar->save();
                //criar acesso
                $this->criar($validaruser->first()->id, session()->get('key'));

                $request->session()->flash("success", "Successfully updated people");
                return redirect()->route('people.index');
            } else {
                //associar ao usuario validando o email
                $associar = People::where('email', $people->email)->first();
                $associar->user_id = $validaruser->first()->id;
                $associar->save();
                //logs
                $this->adicionar_log('1', 'U', $people);
                //criar acesso
                $this->criar($validaruser->first()->id, session()->get('key'));
                $request->session()->flash("success", "Successfully updated people");
                return redirect()->route('people.index');
            }
        } else {
            //se estiver desmarcado o criar conta, apenas adiciona a pessoa
            $this->adicionar_log('1', 'U', $people);
            $request->session()->flash("success", "Successfully updated people");
            return redirect()->route('people.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $user_id)
    {
        $this->pegar_tenant();
        $validargrupo = People_Groups::where('user_id', $id);

        //valdiar grupo antes de excluir
        if ($validargrupo->count() >= 1) {
            session()->flash("info", "Pessoa possui vinculo com grupos, precisa desassociar");
            return redirect()->back();
        }
        //caso esteja zerado
        if ($validargrupo->count() == 0) {
            //deletar pessoa
            $people = people::find($id);
            if ($people) {
                $people->delete();
                $this->adicionar_log('1', 'D', $people);
            }
            //deletar o acesso
            if ($user_id != 0) {
                $validaracesso = Users_Account::where('user_id', $user_id)->where('account_id', session()->get('key'));
                $validaracesso->delete();
                $this->adicionar_log_global('11', 'D', '{"people_id":"' . $id . '","account_id":"' . session()->get('key') . '","user_id":"' . $user_id . '"}');
                //$this->adicionar_log('11', 'D', $validaracesso->get());
            }
            session()->flash("warning", "Sucessfully deleted people");
            return redirect()->route('people.index');
            return redirect()->back();
        }
    }

    public function searchHistoric(Request $request, People $people)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);
        $you = auth()->user();
        //permissao
        $roles = People::where('user_id', $you->id)->with('roleslocal')->first();
        $dataForm = $request->except('_token');
        $date = date('Y');
        $statuses = Status::all()->where("type", 'people');
        $peoples =  $people->search($dataForm, $this->totalPagesPaginate);

        return view('people.index', compact('peoples', 'dataForm', 'roles', 'date', 'statuses'));
    }

    public function criar($user_id, $accout_id): array
    {
        DB::beginTransaction();
        $useraccount = new Users_Account();
        $useraccount->user_id = $user_id;
        $useraccount->account_id = $accout_id;
        $useraccount->save();

        if ($useraccount) {
            $this->adicionar_log_global('11', 'C', $useraccount);
            DB::commit();

            return [
                'success' => true,
                'message' => 'Criado o acesso!',
            ];
        } else {

            DB::rollback();

            return [
                'success' => false,
                'message' => 'Ocorreu um erro!',
            ];
        }
    }
}
