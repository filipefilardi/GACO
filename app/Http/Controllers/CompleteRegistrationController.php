<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CompleteRegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO MIDDLEWARE
    }

    public function indexCompleteRegistration()
    {
    	
        return view('complete_registration')->with('id_cat',2);
    }

    public function completeRegistration()
    {
        
    }
}
