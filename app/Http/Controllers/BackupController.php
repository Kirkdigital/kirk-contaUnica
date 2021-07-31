<?php

namespace App\Http\Controllers;

use App\Models\Config_system;
use Illuminate\Http\Request;
use App\Excel\UsersExport;
use App\Excel\UsersImport;
use Maatwebsite\Excel\Facades\Excel;



class BackupController extends Controller
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
            return redirect()->route('account.index')->withErrors(['error' => __('events.select_account')]);
        
        $you = auth()->user();
        //pegar configurações 
        $config = Config_system::all();
        //pegar a data
        $ldate = date('Y-m');


        $tenant = session()->get('schema');

        return view('dashboard.backup.index', compact('config','tenant'));
    }

    public function backup()
    {
       return view('import');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(Request $request) 
    {        
        return Excel::download(new UsersExport, 'users.xlsx');

        $request->session()->flash("success", "Successfully export");
        return back();
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        Excel::import(new UsersImport,request()->file('file'));
        
        if(request()->file('file') === null)
        {
            $request->session()->flash("info", "Erro import");
        }
        $request->session()->flash("success", "Successfully import");
        return back();
    }
}
