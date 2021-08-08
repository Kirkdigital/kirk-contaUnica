<?php

namespace App\Http\Controllers;

use App\Models\Config_system;
use App\Models\Config_meta;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class ConfigSystemController extends Controller
{

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
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        return view('settings.index');
    }

    public function indexSystem()
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);
        $settings = Config_system::orderBy('id', 'desc')->first();
    
        return view('settings.system', compact('settings'));
    }
    public function indexMeta()
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('events.select_account')]);

        $settings = Config_meta::orderBy('id', 'desc')->first();
        return view('settings.meta', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSystem(Request $request)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        $settings = new Config_system();
        $settings->delete_institution       = $request->has('delete_institution')? 1 : 0;
        $settings->delete_people       = $request->has('delete_people')? 1 : 0;
        $settings->delete_note       = $request->has('delete_note')? 1 : 0;
        $settings->delete_group       = $request->has('delete_group')? 1 : 0;
        $settings->delete_financial       = $request->has('delete_financial')? 1 : 0;
        $settings->delete_calendar       = $request->has('delete_calendar')? 1 : 0;
        $settings->view_periodo       = $request->has('view_periodo')? 1 : 0;
        $settings->view_dash       = $request->has('view_dash')? 1 : 0;
        $settings->view_detail       = $request->has('view_detail')? 1 : 0;
        $settings->view_resumo_financeiro       = $request->has('view_resumo_financeiro')? 1 : 0;
        $settings->add_people       = $request->has('add_people')? 1 : 0;
        $settings->add_institution       = $request->has('add_institution')? 1 : 0;
        $settings->edit_institution       = $request->has('edit_institution')? 1 : 0;
        $settings->add_group       = $request->has('add_group')? 1 : 0;
        $settings->edit_people       = $request->has('edit_people')? 1 : 0;
        $settings->user_id       = auth()->user()->id;
        $settings->save();
        $request->session()->flash("success", "Successfully updated");
        return redirect()->route('settings');
    }
    public function updateMeta(Request $request)
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao'));
        $settings = new  Config_meta();
        $settings->visitante_mes       = $request->input('visitante_mes');
        $settings->grupo_ativo_mes       = $request->input('grupo_ativo_mes');
        $settings->batismo_mes       = $request->input('batismo_mes');
        $settings->conversao_mes       = $request->input('conversao_mes');
        $settings->pessoa_mes       = $request->input('pessoa_mes');
        $settings->visualizacao_mes       = $request->input('visualizacao_mes');
        $settings->comentario_mes       = $request->input('comentario_mes');
        $settings->visitante_ano       = $request->input('visitante_ano');
        $settings->grupo_ativo_ano       = $request->input('grupo_ativo_ano');
        $settings->batismo_ano       = $request->input('batismo_ano');
        $settings->conversao_ano       = $request->input('conversao_ano');
        $settings->pessoa_ano       = $request->input('pessoa_ano');
        $settings->visualizacao_ano       = $request->input('visualizacao_ano');
        $settings->publicacao_ano       = $request->input('publicacao_ano');
        $settings->publicacao_mes       = $request->input('publicacao_mes');
        $settings->comentario_ano       = $request->input('comentario_ano');
        (float)$settings->fin_dizimo_mes       = $request->input('fin_dizimo_mes');
        (float)$settings->fin_oferta_mes       = $request->input('fin_oferta_mes');
        (float)$settings->fin_despesa_mes       = $request->input('fin_despesa_mes');
        (float)$settings->fin_acao_mes       = $request->input('fin_acao_mes');
        (float)$settings->fin_dizimo_ano       = $request->input('fin_dizimo_ano');
        (float)$settings->fin_oferta_ano       = $request->input('fin_oferta_ano');
        (float)$settings->fin_despesa_ano       = $request->input('fin_despesa_ano');
        (float)$settings->fin_acao_ano       = $request->input('fin_acao_ano');
        $settings->user_id       = auth()->user()->id;
        $settings->ano       = date('Y');
        $settings->save();
        $request->session()->flash("success", "Successfully updated");
        return redirect()->route('settings');
    }
}
