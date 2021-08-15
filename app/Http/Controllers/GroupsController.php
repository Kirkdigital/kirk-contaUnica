<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Status;
use App\Models\Group;
use App\Models\Config_system;
use App\Models\People_Groups;
use App\Http\Controllers\Input;
use App\Models\People;

class GroupsController extends Controller
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
    public function index(Group $group)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        $groups = Group::orderBy('name_group', 'asc')->with('status')->with('responsavel')->with('grouplist')->paginate($this->totalPagesPaginate);
        $config = Config_system::orderBy('id', 'desc')->first();
        return view('group.index', compact('groups', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all()->where("type", 'people');
        return view('group.createForm', ['statuses' => $statuses]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->all([
            'name_group'             => 'required|min:1|max:255',
            'tipo'           => 'required',
        ]);

        $group = new Group();
        $group->name_group          = $request->input('name_group');
        $group->type         = $request->input('tipo');
        $group->user_id        = $request->input('itemName');
        $group->status_id      = $request->input('status_id');
        $group->note       = $request->input('note');
        $this->pegar_tenant();
        $group->save();
        $request->session()->flash("success", "Successfully created group");
        return redirect()->route('group.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->pegar_tenant();
        $group = Group::find($id);
        $statuses = Status::all()->where("type", 'people');
        return view('group.EditForm', ['statuses' => $statuses, 'group' => $group]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name_group'             => 'required|min:1|max:255',
            'tipo'           => 'required',

        ]);
        $this->pegar_tenant();
        $group = Group::find($id);
        $group->name_group          = $request->input('name_group');
        $group->type         = $request->input('tipo');
        $group->user_id        = $request->input('itemName');
        $group->status_id      = $request->input('status_id');
        $group->note       = $request->input('note');
        session()->flash("success", "Successfully updated group");
        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->pegar_tenant();
        $group = Group::find($id);
        if ($group) {
            $group->delete();
        }
        session()->flash("warning", "Sucessfully deleted group");
        return redirect()->route('group.index');
    }


    public function searchHistoric(Request $request, Group $group)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

            $config = Config_system::orderBy('id', 'desc')->first();
            $dataForm = $request->except('_token');
        $groups =  $group->search($dataForm, $this->totalPagesPaginate);

        return view('group.index', compact('groups', 'dataForm', 'config'));
    }

    public function show($id)
    {
        $this->pegar_tenant();
        $group = Group::find($id);
        $pessoasgrupos = People_Groups::with('grupo')->with('usuario')->where('group_id',$id)->get();
        $responsavel = People::find($group->user_id);
        //$pessoasgrupo = Group::with('grouplist', 'user_id');
        //$pessoasgrupo = People_Groups::with('grouplista');

       //@dump($pessoasgrupo);
        return view('group.show', compact('group', 'responsavel'), ['pessoasgrupos' => $pessoasgrupos]);
    }

    public function storepeoplegroup(Request $request)
    {
        $value = $request->session()->get('group');
        $validatedData = $request->all([
            'itemName'             => 'required',
        ]);

        $adicionarpessoa = new People_Groups();
        $adicionarpessoa->group_id          = $value;
        $adicionarpessoa->user_id        = $request->input('itemName');
        $adicionarpessoa->registered = date('Y-m-d H:m:s');
        $this->pegar_tenant();
        $validarpessoa = People_Groups::where('user_id', $request->input('itemName'))->where('group_id', $value);
        //pegar valor para somar
        $adicionarsoma = Group::find($value);
        $adicionarsoma->count = $adicionarsoma->count+1;

        //validacao para inserir um valor igual
        if ($validarpessoa->count() == 0) {
            DB::commit();
            //$validarpessoa->count;

            //DB::select('update * from group where id = ?', [$value]);

            $adicionarsoma->save();
            $adicionarpessoa->save();
            

            $request->session()->flash("success", "Adicionado com sucesso");
            return redirect()->back();

        }
        $request->session()->flash("info", "Pessoa já adicionada");
        return redirect()->back();
    }

    public function destroygroup(Request $request, $id)
    {
        $value = $request->session()->get('group');

        $this->pegar_tenant();
        $group = People_Groups::find($id);
        if ($group) {
            $group->delete();
            $adicionarsoma = Group::find($value);
            $adicionarsoma->count = $adicionarsoma->count-1;
            $adicionarsoma->save();
        }
        session()->flash("warning", "Deletada a pessoa do grupo");
        return redirect()->back();
    }
}
