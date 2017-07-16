<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\GarbageDao;
use App\Util\Dao\RequestDao;
use App\Util\Dao\UserDao;
use Auth;
use Gate;

class RequestController extends Controller
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
    public function index_user(Request $data) {
         if (Gate::allows('execute', 'create_request')) {

            // check whether the registration is complete or its a master user
            $is_complete = UserDao::getInfo(Auth::user()->id_user,Auth::user()->id_cat);
            if($is_complete->count()>0 || Auth::user()->id_cat == 4){
                $garbage = GarbageDao::get_list_garbage_actv();
                return view('request', ['garbage' => $garbage]);
            }else{
                $data->session()->flash('alert-warning', 'warning');
                return redirect('/home');
            }


        }else{

            return view('/home');

        }
    }

    public function make_request(Request $data){

        if (Gate::allows('execute', 'create_request')) {
            
            Auth::user();

            RequestDAO::insert_request($data['id_garbage'],Auth::user()->id_user, $data['desc_req'], $data['mod_req'], $data['status_garbage']);

            $garbage = GarbageDao::get_list_garbage_actv();
            //return view('request', ['garbage' => $garbage])->with('status', 'PIROCA!');
            $data->session()->flash('alert-success', 'sucess');
            return redirect('/request');

        }else{

            return view('/home');
            
        }
    }

}
