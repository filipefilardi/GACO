<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestDao;
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
    public function index_admin() {
 		Auth::user();
        $request = RequestDAO::get_full_info_dashboard_req_by_user(Auth::user()->id_user);
        if(Auth::user()->id_cat != 4){ // apenas para admin
            return redirect('/home');
        }
        else {
            return view('admin', ['request' => $request]);
        }
    }
}
