<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestDao;
use App\Util\Dao\UserDao;
use Auth;

class EvaluationController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_evaluation() {
         
    	Auth::user();
        $id_user = Auth::user()->id_user;
        $request = RequestDAO::get_comp_conf_requests_by_user($id_user);
        #dd($request);
        
        return view('/evaluation')->with("request",$request);
    }
}
