<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {
        if($this->middleware('user')){
            //se nao selecionou a conta retornar para a selecao da conta
            //se tiver, volta para a tela do home
            return redirect()->route('home.index');
        }
        //se não carregar o login
        return view('login');
    }
}