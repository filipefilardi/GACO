<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\UserDao;
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
        return view('complete_registration')->with('id_cat',Auth::user()->id_cat);
    }

    public function completeRegistration(Request $request)
    {   
        $res = UserDao::insert(Auth::user()->id_user,$request->all(),Auth::user()->id_cat);
        if($res){
            $request->session()->flash('alert-warning', 'warning');
        }else{
            $request->session()->flash('alert-warning', 'warning');
            
        }
        return redirect('/home');
    }
}