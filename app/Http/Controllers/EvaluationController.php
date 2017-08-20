<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestDao;
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

            #dd($evaluation->punctual_eval);

            return view('/evaluation')
            ->with("request",$comments)
            ->with("avg_ponctuality", $evaluation->punctual_eval)
            ->with("avg_satisfaction", $evaluation->satisf_eval)
            ->with("count", $evaluation->count);
        }
        
        return view('/evaluation')->with("request",$request);
    }

    public function make_evaluation(Request $data){
        $id_coop = Auth::user()->id_user;
        EvaluationDAO::insert_evaluation($data->punctual, $data->satisf, $data->$obs, $data->id_req, $id_coop);
    }
}
