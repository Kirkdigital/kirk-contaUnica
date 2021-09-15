<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Status;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Users_Account;

class InstitutionsController extends Controller
{

    private $totalPagesPaginate = 8;
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
        //mater toda a sessao
        session()->forget('schema');
        session()->forget('key');
        session()->forget('conexao');

        $institutions = Users_Account::where('user_id', $you->id)
            ->with('accountlist')
            ->with('status')
            ->paginate($this->totalPagesPaginate);
        //$institution = Institution::orderBy('name_company', 'asc')->with('status')->with('AccountList')->paginate(10);
        return view('account.List', ['institutions' => $institutions]);
    }

    public function license_index(Request $request)
    {
        $you = auth()->user();
        $countinstlist = Institution::where('integrador', $you->id)->get();
        $countinst = $countinstlist->whereNull('deleted_at')->count();

        if ($request->ajax()) {

            $data = Institution::select('*')->where('integrador', $you->id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="{{route(tenant,[id =>' . $row->id . ']) }}" data-toggle="tooltip" data-id=" class="btn btn-primary-outline edit"><i class="c-icon c-icon-sm cil-pencil text-success"></i></a>';

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
        $institution = Institution::orderBy('name_company', 'desc')->where('integrador', $you->id)->with('status')->paginate(100);
        $countinstlist = Institution::where('integrador', $you->id)->get();
        $countinst = $countinstlist->whereNull('deleted_at')->count();
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
        $you = auth()->user();
        $institution = Institution::find($id);
        if ($institution->integrador == $you->id and $institution->deleted_at == null) {
            return view('account.EditForm', compact('institution'));
        };
        session()->flash("error", 'Error interno');
        return redirect('account');
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
        $countinst = $countinstlist->whereNull('deleted_at')->count();

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
        $countinst = $countinstlist->whereNull('deleted_at')->count();
        if ($countinst >= $you->license) {
            $request->session()->flash("error", 'events.error_license');
            return redirect('account');
        };

        $validatedData = $request->validate([
            'name_company'             => 'required|min:1|max:64',
            'email'           => 'required',
            //'status_id'         => 'required',
            'doc'   => 'required',
            'mobile'         => 'required'
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
        $tenant1 = ($string_novo) . '_' . strval($contador + 1);

        $user = auth()->user();
        $institution = new Institution();
        $institution->name_company      = $request->input('name_company');
        $institution->email      = $request->input('email');
        $institution->doc      = $request->input('doc');
        $institution->mobile      = $request->input('mobile');
        $institution->tenant        = preg_replace('/[ -]+/', '_', $tenant1);
        $institution->address1       = $request->input('address1');
        $institution->address2       = $request->input('address2');
        $institution->city       = $request->input('city');
        $institution->state       = $request->input('state');
        $institution->cep       = $request->input('cep');
        $institution->lat       = $request->input('lat');
        $institution->lng       = $request->input('lng');
        $institution->status_id = '5';
        $institution->country       = $request->input('country');
        $institution->integrador = $user->id;
        $institution->save();
        $this->adicionar_log_global('9', 'C', $institution);
        $useraccount = new Users_Account();
        $useraccount->user_id = $user->id;
        $useraccount->account_id = Institution::latest('id')->get()->first()->id;
        $useraccount->save();
        $this->adicionar_log_global('11', 'C', $useraccount);

        //criar o esquema (gambiarra)
        DB::select('CREATE SCHEMA ' . $institution->tenant);

        $tenant = (object) array('host' => '127.0.0.1', 'port' => '5432', 'account_name' => 'postgres', 'password' => 'ajvv6679');

        Config::set('database.connections.tenant.host', $tenant->host);
        Config::set('database.connections.tenant.port', $tenant->port);
        Config::set('database.connections.tenant.database', 'tenant');
        Config::set('database.connections.tenant.username', $tenant->account_name);
        Config::set('database.connections.tenant.password', $tenant->password);
        Config::set('database.connections.tenant.schema',  $institution->tenant);

        //dump(config::get('database.connections.tenant'));
        DB::reconnect('tenant');

        $migrated = Artisan::call('migrate:fresh --seed');
        if (!$migrated) {

            $this->adicionar_log_global('9', 'C', '{"schema":"' . $institution->tenant . '"}');
            $request->session()->flash("success", 'events.change_create');

            DB::table(config::get('database.connections.tenant.schema') . '.people')->insert([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status_id' => '14',
                'is_admin' => 'true',
                'role' => '1',
            ]);

            //finalizar a conexao
            DB::purge('tenant');
            //reconectar a base
            DB::reconnect('pgsql');
            return redirect()->route('account.index');
        }
        $request->session()->flash("danger", 'Erro ao rodar migrations');
        return redirect()->route('account.index');
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
            'email'           => 'required',
            'mobile'         => 'required',
            'doc'         => 'required',
            'name_company'         => 'required',
        ]);

        $institution = Institution::find($id);
        $institution->name_company      = $request->input('name_company');
        $institution->doc      = $request->input('doc');
        $institution->email      = $request->input('email');
        $institution->mobile      = $request->input('mobile');
        $institution->address1       = $request->input('address1');
        $institution->address2       = $request->input('address2');
        $institution->city       = $request->input('city');
        $institution->state       = $request->input('state');
        $institution->lat       = $request->input('lat');
        $institution->lng       = $request->input('lng');
        $institution->cep       = $request->input('cep');
        $this->adicionar_log_global('9', 'U', $institution);
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
            //$institution->delete();
            $institution = Institution::find($id);
            $institution->deleted_at          = date('Y-m-d H:m:s');
            $this->adicionar_log_global('9', 'D', $institution);
            $institution->save();
        }

        $User_account = Users_Account::where('account_id', '=', $id);
        if ($User_account) {
            $User_account->delete();
            $this->adicionar_log_global('11', 'D', '{"delete_account_list":"' . $id . '"}');
        }
        $request->session()->flash("warning", 'events.change_delete');
        return redirect()->route('account.index');
    }


    public function tenant(Request $request, $id)
    {
        //mater toda a sessao
        $request->session()->forget('schema');
        $request->session()->forget('key');
        $request->session()->forget('conexao');

        $results = DB::select('select * from admin.accounts where id = ?', [$id]);

        //inserir na array dos dados
        $request->session()->put('schema', $results);

        //inserir o código
        $request->session()->put('key', $id);

        //pegar valor na sesscion
        $tenant = $request->session()->get('schema');

        foreach ($tenant as $element) {
            $a = $element->tenant;
        }

        // Make sure to use the database name we want to establish a connection.
        // Setando os dados da nova conexão.
        Config::set('database.connections.tenant.schema', $a);

        //inserir o nome da conexão
        $request->session()->put('conexao', $a);
        // Conecta no banco
        //DB::reconnect('tenant');

        // Testa a nova conexão
        //Schema::connection('tenant')->getConnection()->reconnect();
        //ver os dados de conexão.
        //dump(Schema::connection('tenant')->getConnection());

        return redirect()->route('home.index');
    }
}
