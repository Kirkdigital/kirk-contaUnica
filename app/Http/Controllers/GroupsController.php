<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Status;
use App\Models\Group;
use App\Models\People_Groups;
use App\Models\People;


class GroupsController extends Controller
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
        $this->middleware('permission');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $you = auth()->user();
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        $groups = Group::orderBy('name_group', 'asc')->with('status')->with('responsavel')->with('grouplist')->paginate($this->totalPagesPaginate);
        return view('group.index', compact('groups'));
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
        $this->pegar_tenant();
        $validatedData = $request->all([
            'name_group'             => 'required|min:1|max:255',
            'tipo'           => 'required',
        ]);

        $group = new Group();
        $group->name_group          = $request->input('name_group');
        $group->type         = $request->input('tipo');
        $group->user_id        = $request->input('itemName');
        $group->status_id      = $request->input('status_id');
        $group->count      = '1';
        $group->note       = $request->input('note');
        $group->save();
        $this->adicionar_log('2', 'C', $group);

        $contador = Group::latest('id')->get()->first()->id;
        $adicionarpessoa = new People_Groups();
        $adicionarpessoa->group_id          = $contador;
        $adicionarpessoa->user_id        = $request->input('itemName');
        $adicionarpessoa->registered = date('Y-m-d H:m:s');
        $adicionarpessoa->save();
        $this->adicionar_log('12', 'C', $adicionarpessoa);

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

        //buscar o id grupo
        $group1 = Group::find($id);
        //filtrar nos grupos a pessoa
        //deletar do usuário antigo e atual
        $validaruser = People_Groups::where('group_id', $id)->whereIn('user_id', [$group1->user_id, $request->input('itemName')]);
        if ($validaruser) {
            $validaruser->delete();
            $this->adicionar_log('12', 'D', '{"group_id":"' . $id . '","user_id":"' . $group1->user_id . ',' . $request->input('itemName') . '"}');
        }

        $adicionarpessoa = new People_Groups();
        $adicionarpessoa->group_id          =  $id;
        $adicionarpessoa->user_id        = $request->input('itemName');
        $adicionarpessoa->registered = date('Y-m-d H:m:s');
        $adicionarpessoa->save();
        $this->adicionar_log('12', 'U', $adicionarpessoa);

        //fazer a contagem ao inserir
        $group->count = People_Groups::with('grupo')->with('usuario')->where('group_id', $id)->count();
        $this->adicionar_log('2', 'U', $group);
        $group->save();

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
            $this->adicionar_log('2', 'D', $group);
        }
        $validaruser = People_Groups::where('group_id', $id);
        if ($validaruser) {
            $validaruser->delete();
            $this->adicionar_log('12', 'D', '{"delete_peoplegroup":"' . $id . '"}');
        }
        session()->flash("warning", "Sucessfully deleted group");
        return redirect()->route('group.index');
    }


    public function searchHistoric(Request $request, Group $group)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        $you = auth()->user();
        //permissao
        $dataForm = $request->except('_token');
        $groups =  $group->search($dataForm, $this->totalPagesPaginate);

        return view('group.index', compact('groups', 'dataForm'));
    }

    public function show($id)
    {
        $this->pegar_tenant();
        $group = Group::find($id);
        $pessoasgrupos = People_Groups::with('grupo')->with('usuario')->where('group_id', $id)->get();
        $responsavel = People::find($group->user_id);
        $you = auth()->user();
        //permissao
        return view('group.Show', compact('group','responsavel'), ['pessoasgrupos' => $pessoasgrupos]);
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
        $adicionarsoma->count = $adicionarsoma->count + 1;

        //validacao para inserir um valor igual
        if ($validarpessoa->count() == 0) {
            DB::commit();

            //salvar todos os dados
            $adicionarsoma->save();
            $adicionarpessoa->save();
            $this->adicionar_log('12', 'C', $adicionarpessoa);
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
            $adicionarsoma->count = $adicionarsoma->count - 1;
            $adicionarsoma->save();
            $this->adicionar_log('12', 'D', $group);
        }
        session()->flash("warning", "Deletada a pessoa do grupo");
        return redirect()->back();
    }
}
