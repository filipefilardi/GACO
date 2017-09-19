<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestDao;
use App\Util\Dao\RequestMasterDao;
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
        $user_acpt = null;
        $user_pend = null;
        $master_user_acpt = null;
        $master_user_pend = null;
        
        if ($id_cat == 1 || $id_cat == 2) {
            //$request = RequestDAO::get_full_info_dashboard_req_by_user($id_user);
            $master_user_acpt = RequestMasterDao::get_master_by_user_conditional($id_user, 'status_req', '=', 'ACPT');
            $master_user_pend = RequestMasterDao::get_master_by_user_conditional($id_user, 'status_req', '=', 'PEND');

            $count = 0;

            if(sizeof($master_user_acpt) > 0) {
                foreach ($master_user_acpt as $key => $value) {
                    $user_acpt = RequestDao::get_full_info_dashboard_req_by_user_conditional($id_user, 'request.id_req_master', '=', $value->id_req_master);
                    $count++;
                    $master_user_acpt->splice((int)$key + $count, 0, $user_acpt );
                }
            }

            $count = 0;

            if(sizeof($master_user_pend) > 0) {
                foreach ($master_user_pend as $key => $value) {
                    $user_pend = RequestDao::get_full_info_dashboard_req_by_user_conditional($id_user, 'request.id_req_master', '=', $value->id_req_master);
                    $count++;
                    $master_user_pend->splice((int)$key + $count, 0, $user_pend );
                }
            }
            
            //dd($master_user_pend);
            
            $user_acpt = RequestDao::get_full_info_dashboard_req_by_user_conditional($id_user, 'request.status_req', '=', 'ACPT');
            $user_pend = RequestDao::get_full_info_dashboard_req_by_user_conditional($id_user, 'request.status_req', '=', 'PEND');
        }
        else{
            $request = RequestDao::get_pend_requests_for_coop();
            $request_acpt = RequestDao::get_acpt_requests_by_coop($id_user);
        }
        
        if ($id_cat == 4) return redirect('admin');
        
        //dd($request);
        return view('home')->with('request', $request)
                           ->with('request_acpt', $request_acpt)
                           ->with('user_acpt', $user_acpt)
                           ->with('user_pend', $user_pend)
                           ->with('master_user_acpt', $master_user_acpt)
                           ->with('master_user_pend', $master_user_pend);
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
