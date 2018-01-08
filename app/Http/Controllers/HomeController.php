<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestDao;
use App\Util\Dao\RequestMasterDao;
use App\Util\Dao\AddressDao;
use App\Util\Dao\UserDao;
use App\Util\Dao\EvaluationDao;
use App\Util\Utilities;
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

    public function translate_status($requests, $coop){
        foreach($requests as $request){
            if($coop == 1){
                if($request->fl_user_confirm == 'Y'){
                    $request->status_req = "Aceito pelo usuário";
                }else{
                    $request->status_req = "Pendente";
                }
            }else{
                if($request->status_req == 'ACPT'){
                    $request->status_req = "Aceito";
                }else{
                    $request->status_req = "Pendente";
                }
            }
            
        }
    }

    public function check_radius($req, $coop, $radius){
        $req_add = AddressDao::getAddressesById($req->id_add)->toArray()[0];
        $req_lat = $req_add->id_lat;
        $req_lon = $req_add->id_lon;

        $coop_lat = $coop->id_lat;
        $coop_lon = $coop->id_lon;

        $distance = AddressDao::getDistance($req_lat,$req_lon,$coop_lat,$coop_lon);
        
        if($distance/1000 <= $radius){
            return true;
        } 
        else{
            return false;
        } 
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        Auth::user();
        $id_user = Auth::user()->id_user;
        $id_cat = Auth::user()->id_cat;

        $request = null;
        $request_acpt = null;

        // get addresses list
        $address_list = AddressDao::get_all_coop_address();

        //$results = RequestMasterDAO::accept_master_request(3,$id_user, '10/12/2017', '1-0-0');

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
        $master_coop_acpt = null;
        $master_coop_pend = null;

        
        if ($id_cat == 1 || $id_cat == 2) {
            //$request = RequestDAO::get_full_info_dashboard_req_by_user($id_user);
            $master_user_acpt = RequestMasterDao::get_master_by_user_conditional($id_user, 'status_req', '=', 'ACPT');
            $master_user_pend = RequestMasterDao::get_master_by_user_conditional($id_user, 'status_req', '=', 'PEND');
            $this->translate_status($master_user_acpt, 0);
            $this->translate_status($master_user_pend, 0);

            $count = 0;

            if(sizeof($master_user_acpt) > 0) {
                foreach ($master_user_acpt as $key => $value) {
                    $value->period_predicted = Utilities::parsePeriodForUI($value->period_predicted);
                    $user_acpt = RequestDao::get_full_info_dashboard_req_by_user_conditional($id_user, 'request.id_req_master', '=', $value->id_req_master);
                    $count++;
                    $master_user_acpt->splice((int)$key + $count, 0, $user_acpt );
                }
            }

            $count = 0;
            $inside_area = false;

            

            if(sizeof($master_user_pend) > 0) {
                foreach ($master_user_pend as $key => $value) {
                    foreach ($address_list as &$coop) {
                            if($this->check_radius($value, $coop, $coop->id_radius_user) == true){
                                $inside_area = true;
                            }
                    }
                    $user_pend = RequestDao::get_full_info_dashboard_req_by_user_conditional($id_user, 'request.id_req_master', '=', $value->id_req_master);
                    $count++;
                    $master_user_pend->splice((int)$key + $count, 0, $user_pend );
                }
            }
            
            if($inside_area == false && sizeof($master_user_pend) > 0){
                $data->session()->flash('message', 'Infelizmente no momento não existe nenhuma cooperativa que atende sua região.'); 
                $data->session()->flash('alert-warning', 'warning'); 
            }
            
            #$user_acpt = RequestDao::get_full_info_dashboard_req_by_user_conditional($id_user, 'request.status_req', '=', 'ACPT');
            #$user_pend = RequestDao::get_full_info_dashboard_req_by_user_conditional($id_user, 'request.status_req', '=', 'PEND');
        
        }
        
        else if($id_cat == 3){
            $master_coop_pend = RequestMasterDao::get_master_conditional('status_req', '=', 'PEND');
            $master_coop_acpt = RequestMasterDao::get_master_acpt_by_coop($id_user);

            $this->translate_status($master_coop_pend, 1);
            $this->translate_status($master_coop_acpt, 1);

            $coop_add = AddressDao::getAddresses($id_user)->toArray()[0];

            $coop = UserDao::getInfo($id_user,3)->toArray()[0];
            $radius = $coop->id_radius_user;
            $count = 0;

            if(sizeof($master_coop_acpt) > 0) {
                foreach ($master_coop_acpt as $key => $value) {

                    if($this->check_radius($value, $coop_add, $radius) == false){
                        $value->available = false;
                    }else{
                        $value->available = true;
                    }

                    $value->period_predicted = Utilities::parsePeriodForUI($value->period_predicted);
                    $coop_acpt = RequestDao::get_full_info_dashboard_req_conditional('request.id_req_master','=',$value->id_req_master);
                    $count++;
                    $master_coop_acpt->splice((int)$key + $count, 0, $coop_acpt );
                    
                }
            }

            $count = 0;

            if(sizeof($master_coop_pend) > 0) {
                foreach ($master_coop_pend as $key => $value) {

                    if($this->check_radius($value, $coop_add, $radius) == false){
                        $value->available = false;
                    }else{
                        $value->available = true;
                    }
                    $coop_pend = RequestDao::get_full_info_dashboard_req_conditional('request.id_req_master','=',$value->id_req_master);
                    $count++;
                    $master_coop_pend->splice((int)$key + $count, 0, $coop_pend );
                }
            }

        }
        
        #dd($master_user_acpt);

        if ($id_cat == 4) return redirect('admin');

        return view('home')->with('request', $request)
                           ->with('request_acpt', $request_acpt)
                           #->with('user_acpt', $user_acpt)
                           #->with('user_pend', $user_pend)
                           ->with('master_user_acpt', $master_user_acpt)
                           ->with('master_user_pend', $master_user_pend)
                           ->with('master_coop_acpt', $master_coop_acpt)
                           ->with('master_coop_pend', $master_coop_pend);
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
