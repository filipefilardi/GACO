<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\UserDao;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_admin(Request $request) {
 		Auth::user();
        if(Auth::user()->id_cat != 4){ // apenas para admin
            return redirect('/home');
        }
        else {
            return view('admin', ['request' => $request]);
        }
    }

    public function insertCoop(Request $request)
    {   
        $res = UserDao::insert(Auth::user()->id_user,$request->all(),3); // 3 - ID CAT de Coop
        if($res){
            $request->session()->flash('alert-warning', 'warning');
        } else {
            $request->session()->flash('alert-warning', 'warning');
        }
    }
}
