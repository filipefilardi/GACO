<?php

namespace App\Http\Controllers;

use Auth;
use Session;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()) {
            return redirect('/home');
        }

        return view('welcome');
    }

}
