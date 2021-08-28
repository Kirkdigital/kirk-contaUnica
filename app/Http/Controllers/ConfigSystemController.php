<?php

namespace App\Http\Controllers;

use App\Models\Config_email;
use App\Models\Config_system;
use App\Models\Config_meta;
use App\Models\Config_social;
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
        if (session()->get('schema') === null){
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);
        }
        $settings = Config_system::find('1')->first();
        return view('settings.system', compact('settings'));
    }
    public function indexMeta()
    {
        $this->pegar_tenant();
        if (session()->get('schema') === null){
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);
        }
        $settings = Config_meta::orderBy('id', 'desc')->first();
        return view('settings.meta', compact('settings'));
    }
    public function indexSocial()
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('events.select_account')]);

        $settings = Config_social::find('1')->first();
        return view('settings.social', compact('settings'));
    }
    public function indexEmail()
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('events.select_account')]);

        $settings = Config_email::find('1')->first();
        return view('settings.email', compact('settings'));
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
        $this->pegar_tenant();
        $settings = Config_system::find('1');
        $settings->logo       = $request->input('logo');
        $settings->favicon       = $request->input('favicon');
        $settings->name       = $request->input('name');
        $settings->timezone       = $request->input('timezone');
        $settings->default_language       = $request->input('language');
        $settings->currency       = $request->input('currency');
        $settings->obg_last_name       = $request->has('obg_last_name') ? 1 : 0;
        $settings->obg_email       = $request->has('obg_email') ? 1 : 0;
        $settings->obg_mobile       = $request->has('obg_mobile') ? 1 : 0;
        $settings->obg_birth       = $request->has('obg_birth') ? 1 : 0;
        $settings->obg_sex       = $request->has('obg_sex') ? 1 : 0;
        $settings->obg_city       = $request->has('obg_city') ? 1 : 0;
        $settings->obg_state       = $request->has('obg_state') ? 1 : 0;
        $settings->obg_note       = $request->has('obg_note') ? 1 : 0;
        $settings->save();

        $this->adicionar_log('7', 'U', $settings);
        $request->session()->flash("success", "Successfully updated");
        return redirect()->back();
    }

    public function updateEmail(Request $request)
    {
        $this->pegar_tenant();
        $settings = Config_email::find('1');
        $settings->email_from       = $request->input('email_from');
        $settings->smtp_host       = $request->input('smtp_host');
        $settings->smtp_port       = $request->input('smtp_port');
        $settings->smtp_user       = $request->input('smtp_user');
        $settings->smtp_pass       = $request->input('smtp_pass');
        $settings->save();
        $this->adicionar_log('7', 'U', $settings);
        $request->session()->flash("success", "Successfully updated");
        return redirect()->back();
    }

    public function updateSocial(Request $request)
    {
        $this->pegar_tenant();
        $settings = Config_social::find('1');
        $settings->facebook_link       = $request->input('facebook_link');
        $settings->twitter_link       = $request->input('twitter_link');
        $settings->google_link       = $request->input('google_link');
        $settings->youtube_link       = $request->input('youtube_link');
        $settings->linkedin_link       = $request->input('linkedin_link');
        $settings->instagram_link       = $request->input('instagram_link');
        $settings->vk_link       = $request->input('vk_link');
        $settings->site_link       = $request->input('site_link');
        $settings->whatsapp_link       = $request->input('whatsapp_link');
        $settings->telegram_link       = $request->input('telegram_link');
        $settings->save();
        $this->adicionar_log('7', 'U', $settings);
        $request->session()->flash("success", "Successfully updated");
        return redirect()->back();
    }
    public function updateMeta(Request $request)
    {
        $this->pegar_tenant();
        $settings = new Config_meta();
        $settings->ano       = date('Y');
        //mes
        (int)$settings->visitante_mes       = intval($request->input('visitante_ano')/12);
        (int)$settings->grupo_ativo_mes       = intval($request->input('grupo_ativo_ano')/12);
        (int)$settings->batismo_mes       = intval($request->input('batismo_ano')/12);
        (int)$settings->conversao_mes       = intval($request->input('conversao_ano')/12);
        (int)$settings->pessoa_mes       = intval($request->input('pessoa_ano')/12);
        //$settings->visualizacao_mes       = $request->input('visualizacao_ano');
        //$settings->comentario_mes       = $request->input('comentario_ano');
        //$settings->publicacao_mes       = $request->input('publicacao_mes');

        //ano
        $settings->visitante_ano       = $request->input('visitante_ano');
        $settings->grupo_ativo_ano       = $request->input('grupo_ativo_ano');
        $settings->batismo_ano       = $request->input('batismo_ano');
        $settings->conversao_ano       = $request->input('conversao_ano');
        $settings->pessoa_ano       = $request->input('pessoa_ano');
        //$settings->visualizacao_ano       = $request->input('visualizacao_ano');
        //$settings->publicacao_ano       = $request->input('publicacao_ano');
        //$settings->comentario_ano       = $request->input('comentario_ano');
        
        //financeiro
        (int)$settings->fin_dizimo_mes       = intval($request->input('fin_dizimo_ano')/12);
        (int)$settings->fin_oferta_mes       = intval($request->input('fin_oferta_ano')/12);
        (int)$settings->fin_despesa_mes       = intval($request->input('fin_despesa_ano')/12);
        (int)$settings->fin_acao_mes       = intval($request->input('fin_acao_ano')/12);
        (float)$settings->fin_dizimo_ano       = $request->input('fin_dizimo_ano');
        (float)$settings->fin_oferta_ano       = $request->input('fin_oferta_ano');
        (float)$settings->fin_despesa_ano       = $request->input('fin_despesa_ano');
        (float)$settings->fin_acao_ano       = $request->input('fin_acao_ano');
        $settings->save();
        $this->adicionar_log('7', 'U', $settings);
        $request->session()->flash("success", "Successfully updated");
        return redirect()->back();
    }
}
