<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Notes;
use App\Models\Event;
use App\Models\Historic;
use App\Models\Config_meta;
use App\Models\Config_social;
use App\Models\People_Groups;
use App\Models\People_Precadastro;
use App\Models\Roles;
use Overtrue\LaravelLike\Traits\Likeable;

class HomeController extends Controller
{

    use Likeable;
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
    public function index(Historic $historic, Request $request)
    {
        //pegar schema
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('events.select_account')]);

        $you = auth()->user();

        //pegar informações complementares 
        $meta = Config_meta::orderBy('id', 'desc')->first();
        $roles = People::where('user_id', $you->id)->with('roleslocal')->first();
        $auditoria = Auditoria::orderBy('id', 'desc')->first();

        if($auditoria === null)
        {
            $auditoria = new Auditoria();
            $auditoria->activity_id       = '9';
            $auditoria->type       = 'C';
            $auditoria->user_id       = $you->id;
            $auditoria->manipulations       = '{"primeiro_acesso":"yes","ID":"'.$you->id.'"}';
            $auditoria->save();            
            $request->session()->flash("info", "É necessário configurar a conta");
        }

        //numero de pessoas ativas e no ano atual
        $precadastro = People_Precadastro::where('status_id', '21')->count();;

        //eventos para listar depois
        $eventos = Event::whereYear('created_at', date('Y'))->count();
        //recado para listar depois
        $message = Notes::whereYear('created_at', date('Y'))->count();
        //links das redes sociais
        $social = Config_social::find('1')->first();
        //dash de status
        $people = People::all();        
        $peopleativo = $people->count();
        $totalvisitante = $people->where('is_visitor', true)->count();
        $totalbatismo = $people->where('is_baptism', true)->count();
        $totalconversao = $people->where('is_conversion', true)->count();

        //financeiro recente
        $date = date('Y-m');
        $dizimoatual = Historic::where('tipo', '9')->where('date','like', "%$date%")->sum('amount');
        $ofertaatual = Historic::where('tipo', '10')->where('date','like',"%$date%")->sum('amount');
        $doacaoatual = Historic::where('tipo', '11')->where('date','like', "%$date%")->sum('amount');
        $despesaatual = Historic::where('tipo', '12')->where('date','like', "%$date%")->sum('amount');

        $porcentage_dizimo = $this->porcentagem_nx($dizimoatual, $meta->fin_dizimo_mes); // 20
        $porcentage_oferta = $this->porcentagem_nx($ofertaatual, $meta->fin_oferta_mes); 
        $porcentage_doacao = $this->porcentagem_nx($doacaoatual, $meta->fin_acao_mes); // 20
        $porcentage_despesa = $this->porcentagem_nx($despesaatual, $meta->fin_despesa_mes); 

        $tenant = $request->session()->get('schema');
        foreach ($tenant as $element) {
            $a = $element->name_company;
        }

        $user = People::where('user_id', $you->id)->with('roleslocal')->first();
        if($user == null)
        {
            $request->session()->flash("info", "Você não possuiu permissão, por favor contactar administrador da conta");
            return redirect()->route('account.index');
        }
        else
        $id = $user->id;
        $groups = People_Groups::with('grupo')->where('user_id', $id)->get();

        return view('home', 
            compact(
                    'precadastro',
                    'eventos',
                    'message',
                    'social',
                    'a',
                    'you',
                    'user',
                    'roles',
                    'peopleativo',
                    'totalvisitante',
                    'totalbatismo',
                    'totalconversao',
                    'dizimoatual',
                    'ofertaatual',
                    'doacaoatual',
                    'despesaatual',
                    'porcentage_dizimo',
                    'porcentage_oferta',
                    'porcentage_doacao',
                    'porcentage_despesa',
                ), ['groups' => $groups]);
                
    }
        //calcular porcentagem individual x total
        function porcentagem_nx ( $parcial, $total ) {
            if($total == 0) {
                $ratio = 0;
            } else {
                return ( $parcial * 100 ) / $total;
            } 
        }
}
