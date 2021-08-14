<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\TenantController;
use App\Models\Users_Account;

class InstitutionsController extends Controller
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
    public function index()
    {
        $you = auth()->user();

        $institutions = Users_Account::where('user_id', $you->id)->with('accountlist')->with('status')->paginate($this->totalPagesPaginate);  
        //$institution = Institution::orderBy('name_company', 'asc')->with('status')->with('AccountList')->paginate(10);
        return view('account.List',['institutions' => $institutions]);
    }

    public function license_index(Request $request)
    {
        $you = auth()->user();
        $countinstlist = Institution::where('integrador', $you->id)->get();
        $countinst = $countinstlist->count();
       
        if ($request->ajax()) {
           
            $data = Institution::select('*')->where('integrador', $you->id);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="btn btn-primary-outline edit"><i class="c-icon c-icon-sm cil-pencil text-success"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('account.License', compact('countinst'));

    }

    public function license_index1()
    {
        $you = auth()->user();
        $institution = Institution::orderBy('name_company', 'asc')->where('integrador', $you->id)->with('status')->paginate(100);
        $countinstlist = Institution::where('integrador', $you->id)->get();
        $countinst = $countinstlist->count();
        return view('account.License', ['institutions' => $institution], compact('countinst'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institution = Institution::find($id);
        return view('account.EditForm', compact('institution'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $you = auth()->user();
        $countinstlist = Institution::where('integrador', $you->id)->get();
        $countinst = $countinstlist->count();

        $statuses = Status::all()->where("type", 'system');

        if ($countinst >= $you->license) {
            $request->session()->flash("error", 'events.error_license');
            return redirect('account');
        };

        return view('account.createForm', ['statuses' => $statuses]);
    }


    public function store(Request $request)
    {
        $you = auth()->user();
        $countinstlist = Institution::where('integrador', $you->id)->get();
        $countinst = $countinstlist->count();
        if ($countinst >= $you->license) {
            $request->session()->flash("error", 'events.error_license');
            return redirect('account');
        };

        $validatedData = $request->validate([
            'name_company'             => 'required|min:1|max:64',
            'email'           => 'required',
            //'status_id'         => 'required',
            'doc'   => 'required',
            'mobile'         => 'required',
            'country'         => 'required'
        ]);

        //tratamento no nome para criar o esquema
        $string = $request->input('name_company');
        $string_novo = strtolower(preg_replace(
            "[^a-zA-Z0-9-]",
            "-",
            strtr(
                utf8_decode(trim($string)),
                utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
                "aaaaeeiooouuncAAAAEEIOOOUUNC-"
            )
        ));
        $contador = Institution::latest('id')->get()->first()->id;
        $tenant1 = ($string_novo).'_'. strval($contador+1);
        
        $user = auth()->user();
        $institution = new Institution();
        $institution->name_company      = $request->input('name_company');
        $institution->email      = $request->input('email');
        $institution->doc      = $request->input('doc');
        $institution->mobile      = $request->input('mobile');
        $institution->tenant        = preg_replace('/[ -]+/' , '_' , $tenant1);
        $institution->address1       = $request->input('address1');
        $institution->address2       = $request->input('address2');
        $institution->city       = $request->input('city');
        $institution->state       = $request->input('state');
        $institution->cep       = $request->input('cep');
        $institution->status_id = '5';
        $institution->country       = $request->input('country');
        $institution->integrador = $user->id;
        $institution->save();

        $useraccount = new Users_Account();
        $useraccount->user_id = $user->id;
        $useraccount->account_id = Institution::latest('id')->get()->first()->id;
        $useraccount->save();


        //return response()->json( [ $this->runMigrations($institution), $institution ], 200);

        $request->session()->flash("success", 'events.change_create');
        return redirect()->route('account.index');

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function runMigrations(Institution $institution){
        $migrated = Artisan::call('tenancy:migrate', [
            '--website_id' => $institution->id,
        ]);

        if( !$migrated ){ // return FALSE for sucess
            return 'Tenant criado com sucesso.';
        }
        return 'Erro ao rodar migrations.';
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email'           => 'required',
            'mobile'         => 'required',
            'address1'         => 'required',
            'city'         => 'required',
            'state'         => 'required',
            'cep'         => 'required'
        ]);

        $institution = Institution::find($id);
        $institution->email      = $request->input('email');
        $institution->mobile      = $request->input('mobile');
        $institution->address1       = $request->input('address1');
        $institution->address2       = $request->input('address2');
        $institution->city       = $request->input('city');
        $institution->state       = $request->input('state');
        $institution->cep       = $request->input('cep');
        $institution->save();
        $request->session()->flash("success", 'events.change_update');
        return redirect()->route('account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $institution = Institution::find($id);
        if ($institution) {
            $institution->delete();
        }

        $User_account = Users_Account::where('account_id', '=', $id);
        if ($User_account) {
            $User_account->delete();
        }

        $request->session()->flash("warning", 'events.change_delete');
        return redirect()->route('account.index');
    }


    public function tenant(Request $request, $id)
    {
        //mater toda a sessao
        $request->session()->forget('schema');

        $results = DB::select('select * from accounts where id = ?', [$id]);

        //inserir na session
        $request->session()->put('schema', $results);
        $request->session()->put('key', $id);

        //pegar valor na sesscion
        $tenant = $request->session()->get('schema');

        foreach ($tenant as $element) {
            $a = $element->tenant;
        }

        // Make sure to use the database name we want to establish a connection.
        // Setando os dados da nova conexão.
        Config::set('database.connections.tenant.schema', $a);
        $request->session()->put('conexao', $a);
        // Conecta no banco
        //DB::reconnect('tenant');

        // Testa a nova conexão
        //Schema::connection('tenant')->getConnection()->reconnect();
        //ver os dados de conexão.
        //dump(Schema::connection('tenant')->getConnection());

        return redirect()->route('dashboard.index');
    }
    
}
