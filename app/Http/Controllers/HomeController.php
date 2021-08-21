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
use App\Models\Config_social;
use App\Models\People_Groups;
use App\Models\People_Precadastro;
use App\Models\Roles;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Overtrue\LaravelLike\Traits\Likeable;
use Doctrine\DBAL\Events;

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

        //numero de pessoas ativas e no ano atual
        $precadastro = People_Precadastro::where('is_verify', false)->count();;

        $eventos = Event::whereYear('created_at', date('Y'))->count();
        $message = Notes::whereYear('created_at', date('Y'))->count();
        $social = Config_social::find('1')->first();

        $tenant = $request->session()->get('schema');
        foreach ($tenant as $element) {
            $a = $element->name_company;
        }

        return view('home', 
            compact(
                    'precadastro',
                    'eventos',
                    'message',
                    'social',
                    'a',
                ));
                
    }
}
