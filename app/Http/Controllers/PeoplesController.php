<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use App\Models\Status;
use App\Models\People;
use App\Models\Config_system;
use App\Models\Institution;
use App\Http\Controllers\Input;

class PeoplesController extends Controller
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
    public function index(People $people)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        $peoples = People::orderBy('name', 'asc')->with('status')->paginate($this->totalPagesPaginate);
        $config = Config_system::all();
        return view('people.index', compact('peoples', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all()->where("type", 'people');
        return view('people.createForm', ['statuses' => $statuses]);
    }

    public function createprecadastro()
    {
        $institutions = Institution::all();
        return view('account.wizard', ['institutions' => $institutions]);
    }
    public function searchHistoric(Request $request, Institution $institution)
    {
        $dataForm = $request->except('_token');
        $institutions =  $institution->search($dataForm, $this->totalPagesPaginate);
        return view('account.wizard', compact('institutions', 'dataForm'));
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
        $people->name          = $request->input('name');
        $people->email         = $request->input('email');
        $people->mobile        = $request->input('mobile');
        $people->birth_at      = $request->input('birth_at');
        $people->address       = $request->input('address');
        $people->city          = $request->input('city');
        $people->state          = $request->input('state');
        $people->cep           = $request->input('cep');
        $people->country       = $request->input('country');
        $people->status_id = $request->input('status_id');
        $people->is_visitor       = $request->input('is_visitor');
        $people->is_transferred       = $request->input('is_transferred');
        $people->is_responsible       = $request->input('is_responsible');
        $people->is_conversion       = $request->input('is_conversion');
        $people->is_baptism       = $request->input('is_baptism');
        $people->sex       = $request->input('sex');
        $people->note       = $request->input('note');
        $people->is_newvisitor = 'false';
        $this->pegar_tenant();
        $people->save();
        $request->session()->flash("success", "Successfully created people");
        return redirect()->route('people.index');
    }

    public function storeprecadastro(Request $request)
    {

        //inserir no banco correto
        $value = $request->session()->get('key');
        Config::set('database.connections.tenant.schema', $value);

        $people = new People();
        $people->name          = $request->input('name');
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
        $people->save();
        $request->session()->flash("success", 'Cadastrado com sucesso, aguardar aprovação do administrador');
        return redirect()->route('account.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        $people = People::find($id);
        $statuses = Status::all()->where("type", 'people');
        return view('people.EditForm', ['statuses' => $statuses, 'people' => $people]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //autocompleto pessoa
    public function dataAjaxAC(Request $request)
    {
        $data = Institution::all();
        if ($request->has('q')) {
            $search = $request->q;
            $data = Institution::select("id", "name_company", "email")
                ->where('name_company', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'             => 'required|min:1|max:255',
            'email'           => 'required',
            'mobile'         => 'required',
            'status_id'         => 'required',
            'country'         => 'required'

        ]);
        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        $people = People::find($id);
        $people->name          = $request->input('name');
        $people->email         = $request->input('email');
        $people->mobile        = $request->input('mobile');
        $people->birth_at      = $request->input('birth_at');
        $people->address       = $request->input('address');
        $people->city          = $request->input('city');
        $people->state          = $request->input('state');
        $people->cep           = $request->input('cep');
        $people->country       = $request->input('country');
        $people->status_id = $request->input('status_id');
        $people->is_visitor       = $request->has('is_visitor') ? 1 : 0;
        $people->is_transferred       = $request->has('is_transferred') ? 1 : 0;
        $people->is_responsible       = $request->has('is_responsible') ? 1 : 0;
        $people->is_conversion       = $request->has('is_conversion') ? 1 : 0;
        $people->is_baptism       = $request->has('is_baptism') ? 1 : 0;
        $people->sex       = $request->input('sex');
        $people->note       = $request->input('note');
        $people->is_newvisitor = 'false';
        $people->save();
        session()->flash("success", "Successfully updated people");
        return redirect()->route('people.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        $people = people::find($id);
        if ($people) {
            $people->delete();
        }
        session()->flash("warning", "Sucessfully deleted people");
        return redirect()->route('people.index');
    }
}
