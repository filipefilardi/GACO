<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestMasterDao;
use App\Util\Dao\RequestDAO;
use App\Util\Dao\EvaluationDao;
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
        $id_cat = Auth::user()->id_cat;
        $id_user = Auth::user()->id_user;

        #dd(EvaluationDao::get_evals_obs_per_coop($id_user));

        if ($id_cat == 3) {

            $comments = EvaluationDAO::get_evals_obs_per_coop($id_user);
            $evaluation = EvaluationDAO::get_evals_per_coop($id_user);
            $punctual_eval = null;
            $satisf_eval = null;
            $count = null;

            if(sizeof($evaluation)>0 || !is_null($evaluation)) {
                $punctual_eval = $evaluation->punctual_eval;
                $satisf_eval = $evaluation->satisf_eval;
                $count = $evaluation->count;
            }
            #dd($evaluation->punctual_eval);

            return view('/evaluation')
            ->with("request",$comments)
            ->with("avg_ponctuality", $punctual_eval)
            ->with("avg_satisfaction", $satisf_eval)
            ->with("count", $count);
        } elseif ($id_cat < 3 and $id_cat >=1) {

            $request = RequestMasterDao::get_master_by_user_conditional($id_user,'request_master.status_req','=', 'COMP');
            #dd($request);
            return view('/evaluation')->with("request",$request)->with("eval_flag", "0");
        
        }
        
        return redirect('/home');
    }

    public function make_evaluation(Request $data){
        $errors = EvaluationDAO::insert_evaluation($data->punctual, $data->satisfac, $data->obs, $data->id_req_master);
        
        return redirect('/evaluation');
    }
}
