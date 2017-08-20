<?php

namespace App\Util\Dao;

use DB;

class EvaluationDao

{
    
    public static function insert_evaluation($punctual, $satisf, $obs, $id_req)
    {

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($punctual) || $punctual <= 0)    array_push($errors, 'Punctuality score null or invalid;');
        if(is_null($satisf) || $satisf <= 0)        array_push($errors, 'Satisfaction score null or invalid;');
        if(is_null($id_req) || $id_req <= 0)        array_push($errors, 'id_req null or invalid;');
        
        // END VALIDATION BLOCK /////////

    	DB::table('coop_evaluation')
        ->whereNotExists(function ($query) use($id_req) {
                $query->select(DB::raw(1))
                    ->from('coop_evaluation')
                    ->whereRaw('coop_evaluation.id_req = ?', $id_req);
        })
        ->insert([
            'punctual_eval' => $punctual,
            'satisf_eval' => $satisf,
            'observation' => $obs,
            'id_req' => $id_req
        ]);
    }

    public static function get_evals_per_coop($id_coop)
    {

        $result = DB::table('coop_evaluation')
                    ->select(DB::raw('  avg(punctual_eval)  AS punctual_eval, 
                                        avg(satisf_eval)    AS satisf_eval, 
                                        count(1)            AS count, 
                                        id_user_assign'))
                    ->join('request_assignment', 'coop_evaluation.id_req', '=', 'request_assignment.id_req')
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
                    ->join('request_assignment', 'coop_evaluation.id_req', '=', 'request_assignment.id_req')
                    ->where('request_assignment.id_user_assign', $id_coop)
                    ->where('request_assignment.id_del', 0)
                    ->where('coop_evaluation.id_del', 0)
                    ->pluck('observation');
                    
        return $result;
    }
}
