<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Status;
use App\Models\People;
use App\Models\Roles;


class LogsController extends Controller
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
    public function index(Auditoria $auditoria)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        $peoples = Auditoria::orderBy('id', 'desc')->with('status_log')->with('user')->paginate($this->totalPagesPaginate);
        $config = Roles::all();
        $types = $auditoria->type();  
        return view('logs.index', compact('peoples', 'config', 'types'));
    }
}
