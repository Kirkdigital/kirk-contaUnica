<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Status;
use App\Models\People_Precadastro;
use App\Models\Config_system;
use App\Models\Institution;
use App\Models\People;
use App\Models\Roles;
use App\Models\Users_Account;

class Peoples_PrecadastroController extends Controller
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
    public function index(People_Precadastro $people_Precadastro)
    {
        session()->forget('aprovada-id');
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        $peoples = People_Precadastro::orderBy('id', 'desc')->with('status')->paginate($this->totalPagesPaginate);
        $status = Status::all()->where("type",'precadastro');
        $config = Roles::all();
        return view('people_precadastro.index', compact('peoples', 'config','status'));
    }
    public function edit($id)
    {
        $this->pegar_tenant();
        $people = People_Precadastro::with('acesso')->find($id);
        $statuses = Status::all()->where("type", 'precadastro');
        return view('people_precadastro.EditForm', ['statuses' => $statuses, 'people' => $people]);
    }

    public function update(Request $request, $id)
    {
        $this->pegar_tenant();
        $validatedData = $request->all([
            'name'             => 'required|min:1|max:255',
            'email'           => 'required',
            'mobile'         => 'required',
        ]);
        
        $people_pre = People_Precadastro::find($id);
        $people_pre->name          = $request->input('name');
        $people_pre->email         = $request->input('email');
        $people_pre->mobile        = $request->input('mobile');
        $people_pre->birth_at      = $request->input('birth_at');
        $people_pre->address       = $request->input('address');
        $people_pre->city          = $request->input('city');
        $people_pre->state          = $request->input('state');
        $people_pre->cep           = $request->input('cep');
        $people_pre->country       = $request->input('country');
        $people_pre->status_id = '22'; //aprovado
        $people_pre->is_verify       = 'true';
        $people_pre->sex       = $request->input('sex');

        $people = new People();
        $people->user_id          = session()->get('aprovada-id');
        $people->name          = $request->input('name');
        $people->email         = $request->input('email');
        $people->mobile        = $request->input('mobile');
        $people->birth_at      = $request->input('birth_at');
        $people->address       = $request->input('address');
        $people->city          = $request->input('city');
        $people->state          = $request->input('state');
        $people->cep           = $request->input('cep');
        $people->country       = $request->input('country');
        $people->status_id = '14'; //ativado
        $people->is_visitor       = $request->input('is_visitor');
        $people->is_transferred       = $request->input('is_transferred');
        $people->is_responsible       = $request->input('is_responsible');
        $people->is_conversion       = $request->input('is_conversion');
        $people->is_baptism       = $request->input('is_baptism');
        $people->is_verify       = 'true';
        $people->sex       = $request->input('sex');
        $people->note       = $request->input('note');
        $response = $this->criar(session()->get('aprovada-id'), session()->get('key'));
        if ($response['success']) {
            $people_pre->save();
            $people->save();
            return redirect('peopleList')
                ->with('success', $response['message']);
        }

        return redirect()
            ->back()
            ->with('error', $response['message']);
        
        $request->session()->flash("success", "Successfully created people");
        return redirect()->route('people_precadastro.index');
    }

    public function criar($user_id, $accout_id): array
    {
        DB::beginTransaction();
        $useraccount = new Users_Account();
        $useraccount->user_id = $user_id;
        $useraccount->account_id = $accout_id;
        $useraccount->save();

        if ($useraccount) {

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
    public function reprovar($id)
    {
        $this->pegar_tenant();
        $people = People_Precadastro::find($id);
        if ($people) {
            $people->delete();
            $people->status_id = '23';
            $people->save();
            session()->flash("info", "Reprovado com sucesso");
            return redirect()->route('peopleList.index');
        }
    }
    public function searchHistoric(Request $request, People_Precadastro $people)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);
        
        $status = Status::all()->where("type",'precadastro');
        $config = Roles::all();
        $dataForm = $request->except('_token');
        $peoples =  $people->search($dataForm, $this->totalPagesPaginate);

        return view('people_precadastro.index', compact('peoples', 'dataForm', 'status','config'));
    }
}
