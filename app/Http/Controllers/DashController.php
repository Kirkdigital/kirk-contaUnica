<?php

namespace App\Http\Controllers;

use App\Models\Config_email;
use App\Models\Config_system;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Notes;
use App\Models\Event;
use App\Models\Historic;
use App\Models\Config_meta;
use App\Models\People_Groups;
use App\Models\Roles;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Overtrue\LaravelLike\Traits\Likeable;
use Doctrine\DBAL\Events;

class DashController extends Controller
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
        $roles = Roles::orderBy('id', 'desc')->first();
        $meta = Config_meta::orderBy('id', 'desc')->first();

        if($meta === null)
        {
            $this->pegar_tenant();
            $settings = new Config_meta();
            $settings->id       = '1';
            $settings->save();
            

            $settings = new Config_system();
            $settings->id       = '1';
            $settings->name       = 'DeskApps';
            $settings->timezone       = 'America/Manaus';
            $settings->save();

            $settings = new Config_email();
            $settings->id       = '1';
            $settings->save();

            $settings = new Roles();
            $settings->id       = '1';
            $settings->id       = 'PADRAO';
            $settings->save();
            
            $request->session()->flash("info", "Configurar a meta nas configurações");
            return redirect()->route('dashboard.index');
        }

        $anoanterior = (date('Y') - '1');
        //numero de pessoas ativas e no ano atual
        $people = People::all();
        $precadastro = People::where('is_verify', false)->count();;
        $financeiro = Historic::all();

        //valor total
        $peopleativo = $people->count();
        $totalvisitante = $people->where('is_visitor', true)->count();
        $totalbatismo = $people->where('is_baptism', true)->count();
        $totalconversao = $people->where('is_conversion', true)->count();
        $sexmascu = $people->where('sex', 'm')->count();
        $sexfemin = $people->where('sex', 'f')->count();
        $totalsex = $people->where('sex')->count();
        $porcentage_m = $this->porcentagem_nx($sexmascu, $totalsex); // 20
        $porcentage_f = $this->porcentagem_nx($sexfemin, $totalsex); 

        //total
        $likes = DB::table('admin.likes')
        ->leftJoin('admin.posts', 'likes.likeable_id', '=', 'posts.id')
        ->where('posts.user_id', '11')
        ->count();
        //ano
        $anolikes = DB::table('admin.likes')
        ->leftJoin('admin.posts', 'likes.likeable_id', '=', 'posts.id')
        ->whereYear('posts.created_at', date('Y'))->count();

        //valor total ano meta
        $anovisitante = People::where('is_visitor', true)->whereYear('created_at', date('Y'))->count();
        $anobatismo = People::where('is_baptism', true)->whereYear('created_at', date('Y'))->count();
        $anoconversao = People::where('is_conversion', true)->whereYear('created_at', date('Y'))->count();
        $anopessoa = People::whereYear('created_at', date('Y'))->count();
        $anogrupo = People_Groups::whereYear('registered', date('Y'))->count();

        $porcentage_visitante = $this->porcentagem_nx($anovisitante, $meta->visitante_ano); // 20
        $porcentage_batismo = $this->porcentagem_nx($anobatismo, $meta->batismo_ano); 
        $porcentage_conversao = $this->porcentagem_nx($anoconversao, $meta->conversao_ano); // 20
        $porcentage_pessoa = $this->porcentagem_nx($anopessoa, $meta->pessoa_ano); 
        $porcentage_grupo = $this->porcentagem_nx($anogrupo, $meta->grupo_ativo_ano); 

        $anodizimo = Historic::where('tipo', '9')->whereYear('date', date('Y'))->sum('amount');
        $anooferta = Historic::where('tipo', '10')->whereYear('date', date('Y'))->sum('amount');
        $anodoacao = Historic::where('tipo', '11')->whereYear('date', date('Y'))->sum('amount');
        $anodespesa = Historic::where('tipo', '12')->whereYear('date', date('Y'))->sum('amount');
        $totalfinanceiro = ($anodizimo + $anooferta + $anodoacao + $anodespesa);

        $porcentage_dizimo = $this->porcentagem_nx($anodizimo, $meta->fin_dizimo_ano); // 20
        $porcentage_oferta = $this->porcentagem_nx($anooferta, $meta->fin_oferta_ano); 
        $porcentage_doacao = $this->porcentagem_nx($anodoacao, $meta->fin_acao_ano); // 20
        $porcentage_despesa = $this->porcentagem_nx($anodespesa, $meta->fin_despesa_ano); 
        $totalporcentagem = ($porcentage_dizimo + $porcentage_oferta + $porcentage_doacao + $porcentage_despesa);
        $porcentage_total = $this->porcentagem_total($totalporcentagem);

        $peoplevisitor = People::where('is_newvisitor', true)->whereYear('created_at', date('Y'))->count();
        $eventos = Event::whereYear('created_at', date('Y'))->count();
        $notes = Notes::whereYear('created_at', date('Y'))->count();


        //financeiro dash
        $metadash = ($meta->first()->fin_dizimo_ano + $meta->first()->fin_oferta_ano + $meta->first()->fin_acao_ano + $meta->first()->fin_despesa_ano)/12;
        //grafico grande
        $fin_atual_jan = Historic::whereYear('date', date('Y'))->whereMonth('date', date('01'))->sum('amount');
        $fin_atual_fev = Historic::whereYear('date', date('Y'))->whereMonth('date', date('02'))->sum('amount');
        $fin_atual_mar = Historic::whereYear('date', date('Y'))->whereMonth('date', date('03'))->sum('amount');
        $fin_atual_abr = Historic::whereYear('date', date('Y'))->whereMonth('date', date('04'))->sum('amount');
        $fin_atual_mai = Historic::whereYear('date', date('Y'))->whereMonth('date', date('05'))->sum('amount');
        $fin_atual_jun = Historic::whereYear('date', date('Y'))->whereMonth('date', date('06'))->sum('amount');
        $fin_atual_jul = Historic::whereYear('date', date('Y'))->whereMonth('date', date('07'))->sum('amount');
        $fin_atual_ago = Historic::whereYear('date', date('Y'))->whereMonth('date', date('08'))->sum('amount');
        $fin_atual_set = Historic::whereYear('date', date('Y'))->whereMonth('date', date('09'))->sum('amount');
        $fin_atual_out = Historic::whereYear('date', date('Y'))->whereMonth('date', date('10'))->sum('amount');
        $fin_atual_nov = Historic::whereYear('date', date('Y'))->whereMonth('date', date('11'))->sum('amount');
        $fin_atual_dez = Historic::whereYear('date', date('Y'))->whereMonth('date', date('12'))->sum('amount');

        $fin_anterior_jan = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('01'))->sum('amount');
        $fin_anterior_fev = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('02'))->sum('amount');
        $fin_anterior_mar = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('03'))->sum('amount');
        $fin_anterior_abr = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('04'))->sum('amount');
        $fin_anterior_mai = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('05'))->sum('amount');
        $fin_anterior_jun = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('06'))->sum('amount');
        $fin_anterior_jul = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('07'))->sum('amount');
        $fin_anterior_ago = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('08'))->sum('amount');
        $fin_anterior_set = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('09'))->sum('amount');
        $fin_anterior_out = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('10'))->sum('amount');
        $fin_anterior_nov = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('11'))->sum('amount');
        $fin_anterior_dez = Historic::whereYear('date', date($anoanterior))->whereMonth('date', date('12'))->sum('amount');

        //financeiro recente
        $date = date('Y-m');
        $dizimoatual = Historic::where('tipo', '9')->where('date','like', "%$date%")->sum('amount');
        $ofertaatual = Historic::where('tipo', '10')->where('date','like',"%$date%")->sum('amount');
        $doacaoatual = Historic::where('tipo', '11')->where('date','like', "%$date%")->sum('amount');
        $despesaatual = Historic::where('tipo', '12')->where('date','like', "%$date%")->sum('amount');

        $formapag_dinheiro = Historic::where('pag', '15')->where('date','like', "%$date%")->sum('amount');
        $formapag_cheque = Historic::where('pag', '16')->where('date','like',"%$date%")->sum('amount');
        $formapag_credito = Historic::where('pag', '17')->where('date','like', "%$date%")->sum('amount');
        $formapag_debito = Historic::where('pag', '18')->where('date','like', "%$date%")->sum('amount');
        $formapag_boleto = Historic::where('pag', '19')->where('date','like', "%$date%")->sum('amount');
        $formapag_pix = Historic::where('pag', '20')->where('date','like', "%$date%")->sum('amount');

        return view('dashboard.homepage', 
            compact('roles', 
                    'peopleativo', 
                    'peoplevisitor', 
                    'meta',
                    'notes',
                    'eventos',
                    'totalvisitante',
                    'sexmascu',
                    'sexfemin',
                    'totalsex',
                    'porcentage_m',
                    'porcentage_f',
                    'anovisitante',
                    'anobatismo',
                    'anoconversao',
                    'anopessoa',
                    'formapag_dinheiro',
                    'formapag_cheque',
                    'formapag_credito',
                    'formapag_debito',
                    'formapag_boleto',
                    'formapag_pix',
                    'porcentage_visitante',
                    'porcentage_batismo',
                    'porcentage_conversao',
                    'porcentage_pessoa',
                    'anodizimo',
                    'anooferta',
                    'anodoacao',
                    'anodespesa',
                    'porcentage_dizimo',
                    'porcentage_oferta',
                    'porcentage_doacao',
                    'porcentage_despesa',
                    'porcentage_total',
                    'totalfinanceiro',
                    'likes',
                    'anolikes',
                    'totalbatismo',
                    'totalconversao',
                    'metadash',
                    'fin_atual_jan',
                    'fin_atual_fev',
                    'fin_atual_mar',
                    'fin_atual_abr',
                    'fin_atual_mai',
                    'fin_atual_jun',
                    'fin_atual_jul',
                    'fin_atual_ago',
                    'fin_atual_set',
                    'fin_atual_out',
                    'fin_atual_nov',
                    'fin_atual_dez',
                    'fin_anterior_jan',
                    'fin_anterior_fev',
                    'fin_anterior_mar',
                    'fin_anterior_abr',
                    'fin_anterior_mai',
                    'fin_anterior_jun',
                    'fin_anterior_jul',
                    'fin_anterior_ago',
                    'fin_anterior_set',
                    'fin_anterior_out',
                    'fin_anterior_nov',
                    'fin_anterior_dez',
                    'dizimoatual',
                    'ofertaatual',
                    'doacaoatual',
                    'despesaatual',
                    'precadastro',
                    'anogrupo',
                    'porcentage_grupo'
                ));
                
    }
    //calcular porcentagem individual x total
    function porcentagem_nx ( $parcial, $total ) {
        if($total == 0) {
            $ratio = 0;
        } else {
            return ( $parcial * 100 ) / $total;
        } 
    }
    //somar a porcentagem x digidir em media
    function porcentagem_total ($parcial) {
            return ( $parcial / 5 );
    }

}
