<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\AddressDao;
use App\Util\Dao\GarbageDao;
use App\Util\Dao\RequestDao;
use App\Util\Dao\RequestMasterDao;
use App\Util\Dao\UserDao;
use App\Util\Utilities;
use App\Http\Controllers\MailController;
use DB;
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

            // check whether the registration is complete
            $is_complete = UserDao::getInfo(Auth::user()->id_user,Auth::user()->id_cat);
            if($is_complete->count()>0){
                $garbage = GarbageDao::get_list_garbage_actv();
                $addresses = AddressDao::getAddresses(Auth::user()->id_user);

                return view('request', ['garbage' => $garbage,'addresses' => $addresses]);
            }else{
                $data->session()->flash('message', 'Você precisa completar sua cadastro antes de fazer uma doação!'); 
                $data->session()->flash('alert-warning', 'warning'); 
                if(Auth::user()->id_cat == 4) return redirect('/admin');
                return redirect('/complete_registration');
            }


        }else{

            return view('/home');

        }
    }

    public function make_request(Request $data){
        $weekday_period = Utilities::parseWeekdaysPeriodToDB($data->all());
        $counter = (int) $data['counter'];

        $res = null;
        $id_master = null;
        $token = null;

        #dd($data->all(),$counter);
        if (Gate::allows('execute', 'create_request')) {

            #dd($data->all());
            for($i = 1; $i <=$counter; $i++) {

                #Auth::user();
                $id_garbage =  $data['id_garbage'. '_' . $i];
                $quantity =  $data['quantity'. '_' . $i];
                $observation =  $data['observation'. '_' . $i];
                $desc_req = "";
                $state = "";
                switch ($id_garbage) {
                    # tv
                    case 15:
                        $state = $data['status_tv'. '_' . $i];
                        break;
                    # cpu
                    case 3:
                        $state = $data['status_cpu'. '_' . $i];
                        $desc_req = $data['others_cpu'. '_' . $i];
                        break;
                    # other
                    case 17:
                        $desc_req = $data['other'. '_' . $i];
                        break;
                }

                #$status_tv = $data['status_garbage'];

                if($state == 'Aberta' && $id_garbage == 15){
                    $data->session()->flash('message', 'A coleta de um televisor aberto é inviabilizada por riscos a saúde, dada a quantidade de chumbo exposta.'); 
                    $data->session()->flash('alert-warning', 'warning');
                    return redirect('/request');
                }
                elseif (!is_numeric($quantity) || $quantity <= 0) {
                    $data->session()->flash('message', 'A quantidade para coleta de um equipamente deve ser positiva. Por favor, confira os campos.'); 
                    $data->session()->flash('alert-warning', 'warning');
                    return redirect('/request');
                }
                 
            }

            // GAMBETA MONSTER
            $returnMaster = RequestMasterDAO::insert_request(Auth::user()->id_user, null, null ,null, $data['id_add'], null, null, $weekday_period[0],$weekday_period[1]);

            list($token,$id_master) = preg_split('~-~', $returnMaster);
            for($i = 1; $i <=$counter; $i++) {

                #Auth::user();
                $id_garbage =  $data['id_garbage'. '_' . $i];
                $quantity =  $data['quantity'. '_' . $i];
                $observation =  $data['observation'. '_' . $i];
                $desc_req = "";
                $state = "";
                switch ($id_garbage) {
                    # tv
                    case 15:
                        $state = $data['status_tv'. '_' . $i];
                        break;
                    # cpu
                    case 3:
                        $state = $data['status_cpu'. '_' . $i];
                        $desc_req = $data['others_cpu'. '_' . $i];
                        break;
                    # other
                    case 17:
                        $desc_req = $data['other'. '_' . $i];
                        break;
                }
                
                $res = RequestDAO::insert_request(Auth::user()->id_user, $id_garbage, $state , $observation, $data['id_add'], $quantity, $desc_req, $id_master, $token);

                if(is_array($res)) {
                    RequestMasterDAO::cancel_master_request($id_master, Auth::user()->id_cat);
                    $id_master = null;
                    break;
                }
            }

            if(!is_null($id_master)){
                $data->session()->flash('message', 'Pedido realizado com sucesso! Anote o seu código ' . $token . ' para a confirmação no momento da coleta.'); 
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
        $data_period = $data['period'];

        if($data['period'] == 'manha') $data['manha'] = 1;
        elseif ($data['period'] == 'tarde') $data['tarde'] = 1;
        else $data['noite'] = 1;

        unset($data['period']);

        
        $weekday_period = Utilities::parseWeekdaysPeriodToDB($data->all());

        if (Gate::allows('execute', 'accept_requests')) {         
            $id_user = Auth::user()->id_user;
            
            $results = RequestMasterDAO::accept_master_request($data['id_req'],$id_user, $data['dateaccept'], $weekday_period[1]);

            if(sizeof($results) == 0){


                $email = $this->get_email_user_by_id_req($data['id_req']);

                // SEND MAIL
                MailController::send_request_accepted($email, $data['dateaccept'], $data_period, $data['id_req']);


                $data->session()->flash('message', 'Doação aceita com sucesso'); 
                $data->session()->flash('alert-success', 'sucess');
            }else{
                $data->session()->flash('message', 'Falha ao aceitar doação. Por favor, tente novamente'); 
                $data->session()->flash('alert-warning', 'warning');
            }
            return redirect('/home');

        } else {

            return view('/home');
            
        }
    }

    public function cancel_request(Request $data){

        if (Gate::allows('execute', 'cancel_requests')) {         
            Auth::user();

            $id_cat = Auth::user()->id_cat;
            $erros = RequestMasterDAO::cancel_master_request($data['id_req'],$id_cat);

            return redirect('/home');

        } else {

            return redirect('/home');
            
        }
    }

    public function postpone_request(Request $data){
        $data_period = $data['period'];

        if($data['period'] == 'manha') $data['manha'] = 1;
        elseif ($data['period'] == 'tarde') $data['tarde'] = 1;
        else $data['noite'] = 1;

        unset($data['period']);

        if (Gate::allows('execute', 'postpone_requests')) {         

            $weekday_period = Utilities::parseWeekdaysPeriodToDB($data->all());

            $id_user = Auth::user()->id_user;
            $id_cat = Auth::user()->id_cat;

            if($id_cat == 1 || $id_cat == 2) $erros = RequestMasterDAO::postpone_request($data['id_req'], $id_user, $id_cat, null,null, $data['justification']);

            elseif($id_cat == 3) {
                $erros = RequestMasterDAO::postpone_request($data['id_req'], $id_user, $id_cat, $data['dateaccept'], $weekday_period[1], $data['justification']);


                
                $email = $this->get_email_user_by_id_req($data['id_req']);

                // SEND MAIL
                MailController::send_request_postpone($email, $data['dateaccept'], $data_period, $data['justification'], $data['id_req']);

            }

            return redirect('/home');

        } else {

            return redirect('/home');
            
        }
    }

    public function confirm_request(Request $data){

        if (Gate::allows('execute', 'confirm_requests')) {         
            Auth::user();

            $id_user = Auth::user()->id_user;
            $id_cat = Auth::user()->id_cat;
            $teste = RequestMasterDAO::confirm_master_request($data['id_req'],$id_user,$id_cat, $data['conf_token'], $data['dt_collected']);

            if(in_array("Seu token de confirmação está incorreto!",$teste)){
                $data->session()->flash('message', 'Seu token de confirmação está incorreto! Por favor, tente novamente'); 
                $data->session()->flash('alert-warning', 'warning');
                return redirect('/home');
            }
            
            if(sizeof($teste) == 0){
                $data->session()->flash('message', 'Coleta confirmada com sucesso'); 
                $data->session()->flash('alert-success', 'sucess');
            }else{
                $data->session()->flash('message', 'Falha ao confirmação da coleta. Por favor, tente novamente'); 
                $data->session()->flash('alert-warning', 'warning');
            }

            return redirect('/home');

        } else {

            return redirect('/home');
            
        }
    }

    public function get_email_user_by_id_req($id_req){

        $id_user_req = DB::table('request_master')->where('id_req_master', $id_req)->value('id_user_req');
        
        $email = DB::table('users')->where('id_user', $id_user_req)->value('email');

        return $email;
    }

}
