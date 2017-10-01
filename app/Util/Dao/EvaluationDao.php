<?php

namespace App\Util\Dao;

use DB;

class EvaluationDao

{
    
    public static function insert_evaluation($punctual, $satisf, $obs, $id_req_master)
    {
        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($punctual) || $punctual <= 0)    array_push($errors, 'Punctuality score null or invalid;');
        if(is_null($satisf) || $satisf <= 0)        array_push($errors, 'Satisfaction score null or invalid;');
        if(is_null($id_req_master) || $id_req_master <= 0)        array_push($errors, 'id_req_master null or invalid;');
        
        // END VALIDATION BLOCK /////////

    	$existing = DB::table('coop_evaluation')
                    ->where('coop_evaluation.id_req_master', $id_req_master)
                    ->where('coop_evaluation.id_del', 0)
                    ->value('id_eval');

        $id_req_master_exists = DB::table('request_master')
                    ->where('request_master.id_req_master', $id_req_master)
                    ->where('request_master.id_del', 0)
                    ->where('request_master.status_req', 'COMP')
                    ->value('id_req_master');

        if($existing == null) {
            if($id_req_master_exists ==  $id_req_master) {
                DB::table('coop_evaluation')
                ->insert([
                    'punctual_eval' => $punctual,
                    'satisf_eval' => $satisf,
                    'observation' => $obs,
                    'id_req_master' => $id_req_master
                ]);
                $errors = array();
            } else array_push($errors, 'Invalid request for evaluation for this id_req_master;');
        } else array_push($errors, 'Evaluation already exists on the database for this id_req_master;');
 
        return $errors;
    }

    public static function get_evals_per_coop($id_coop)
    {

        $result = DB::table('coop_evaluation')
                    ->select(DB::raw('  avg(punctual_eval)  AS punctual_eval, 
                                        avg(satisf_eval)    AS satisf_eval, 
                                        count(1)            AS count, 
                                        id_user_assign'))
                    ->join('request_assignment', 'coop_evaluation.id_req_master', '=', 'request_assignment.id_req_master')
                    ->where('request_assignment.id_user_assign', $id_coop)
                    ->where('request_assignment.id_del', 0)
                    ->where('coop_evaluation.id_del', 0)
                    ->groupBy('id_user_assign')
                    ->first();
                    
        return $result;
    }

    public static function get_evals_obs_per_coop($id_coop)
    {

        $result = DB::table('coop_evaluation')
                    ->join('request_assignment', 'coop_evaluation.id_req_master', '=', 'request_assignment.id_req_master')
                    ->where('request_assignment.id_user_assign', $id_coop)
                    ->where('request_assignment.id_del', 0)
                    ->where('coop_evaluation.id_del', 0)
                    ->pluck('observation');
                    
        return $result;
    }
}
