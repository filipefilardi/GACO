<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestDao;
use App\Util\Dao\UserDao;
use Auth;
use Session;

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
        $id_user = Auth::user()->id_user;
        $id_cat = Auth::user()->id_cat;

        $request = null;
        $request_acpt = null;

        // check whether the account is deleted
        $user_status = UserDao::getStatus($id_user);
        // logout!
        if($user_status == 1){
            Auth::logout();
            Session::flush();
            return redirect('/');

        }

        if ($id_cat == 1 || $id_cat == 2) {
            $request = RequestDAO::get_full_info_dashboard_req_by_user($id_user);
        }
        else{
            $request = RequestDAO::get_pend_requests_for_coop();
            $request_acpt = RequestDAO::get_acpt_requests_by_coop($id_user);
        }
        $user_acpt = array();
        $user_pend = array();
        foreach ($request as $r) {
            if($r->status_req == "ACPT"){
                $user_acpt[] = $r;
            }else{
                $user_pend[] = $r;
            }
        }
        return view('home')->with('request', $request)
                           ->with('request_acpt', $request_acpt)
                           ->with('user_acpt', $user_acpt)
                           ->with('user_pend', $user_pend);
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
}
