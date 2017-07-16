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
        if (Auth::user()->id_user == 1 || Auth::user()->id_user == 2) {
            $request = RequestDAO::get_full_info_dashboard_req_by_user(Auth::user()->id_user);   
        }
        else{
            $request = RequestDAO::get_pend_requests_for_coop();
        }
        

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
