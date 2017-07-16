<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestDao;
use Auth;

class HomeController extends Controller
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
    public function index()
    {
        Auth::user();
        $request = RequestDAO::get_full_info_dashboard_req_by_user(Auth::user()->id_user);

        // request testing 
        // RequestDAO::insert_request(5,4,'abcedf','tester','Completo');
        // RequestDAO::insert_request(5,4,'abcedf','tester','Completo');
        // RequestDAO::assign_request(1,5,'20170608');
        // RequestDAO::update_request(1,'COMP');
        // RequestDAO::confirm_request(1,4);
        // RequestDAO::confirm_request(1,5);

        return view('home', ['request' => $request]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_about()
    {
        return view('about');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_partners()
    {
        return view('partners');
    }
}
