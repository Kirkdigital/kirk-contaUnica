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
        if($this->middleware('admin')){
            if (($request->session()->get('schema')) === null)
            return redirect()->route('account.index');
            else
            return redirect()->back();
        }
        else{
            return redirect()->route('posts.posts');
        }
        return view('welcome');
        
    }
}