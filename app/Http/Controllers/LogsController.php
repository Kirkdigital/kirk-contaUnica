<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
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
        $this->middleware('permission');
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
        $types = $auditoria->type();  
        return view('logs.index', compact('peoples', 'types'));
    }
}
