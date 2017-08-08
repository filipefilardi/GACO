<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\AddressDao;
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
                $addresses = AddressDao::getAddresses(Auth::user()->id_user);

                return view('request', ['garbage' => $garbage,'addresses' => $addresses]);
            }else{
                $data->session()->flash('message', 'Você precisa completar sua cadastro antes de fazer uma doação!'); 
                $data->session()->flash('alert-warning', 'warning'); 
                return redirect('/complete_registration');
            }


        }else{

            return view('/home');

        }
    }

    public function make_request(Request $data){
        $res = null;
        if (Gate::allows('execute', 'create_request')) {
            
            Auth::user();


            $status_tv = $data['status_garbage'];
            $id_garbage =  $data['id_garbage'];
            if($status_tv == 'Aberta' && $id_garbage == 15){
                $data->session()->flash('message', 'Não é possível fazer a coleta de um televisor aberto :('); 
                $data->session()->flash('alert-warning', 'warning');
                return redirect('/request');
            }

            $res = RequestDAO::insert_request(Auth::user()->id_user, $id_garbage, $data['status_tv'], $data['observation'], $data['id_add'], $data['quantity']);

            if(is_string($res)){
                $data->session()->flash('message', 'Pedido realizado com sucesso! Anote o seu código ' . $res . ' para a confirmação no momento da coleta.'); 
                $data->session()->flash('alert-success', 'sucess');
                return redirect('/request');
            }else{
                $data->session()->flash('message', 'Falha no pedido. Por favor, preencha os dados novamente.'); 
                $data->session()->flash('alert-warning', 'warning');
                return redirect('/request');
            }

            

        }else{

            return view('/home');
            
        }
    }

    public function accept_request(Request $data){


        if (Gate::allows('execute', 'accept_requests')) {         
            Auth::user();

            $teste = RequestDAO::assign_request($data['id_req'],Auth::user()->id_user, $data['date']);

            //$data->session()->flash('alert-success', 'sucess');
            return redirect('/home');

        } else {

            return view('/home');
            
        }
    }

    public function cancel_request(Request $data){

        if (Gate::allows('execute', 'cancel_requests')) {         
            Auth::user();

            $id_cat = Auth::user()->id_cat;
            $teste = RequestDAO::cancel_request($data['id_req'],$id_cat);

            return redirect('/home');

        } else {

            return redirect('/home');
            
        }
    }

        public function confirm_request(Request $data){

        if (Gate::allows('execute', 'confirm_requests')) {         
            Auth::user();

            // TODO Pass DAte of Collect from UI to confirm_request function of DAO - needs to come on $data

            $id_cat = Auth::user()->id_cat;
            $id_user = Auth::user()->id_user;
            $teste = RequestDAO::confirm_request($data['id_req'],$id_user, $id_cat, $data['conf_token'], $data['dt_collected']);


            return redirect('/home');

        } else {

            return redirect('/home');
            
        }
    }

}
