<?php

namespace App\Util\Dao;

use DB;

class EvaluationDao

{
    
    public static function insert_evaluation($punctual, $satisf, $obs, $id_req, $id_coop)
    {

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($punctual) || $punctual <= 0)    array_push($errors, 'Punctuality score null or invalid;');
        if(is_null($satisf) || $satisf <= 0)        array_push($errors, 'Satisfaction score null or invalid;');
        if(is_null($id_req) || $id_req <= 0)        array_push($errors, 'id_req null or invalid;');
        if(is_null($id_coop) || $id_coop <= 0)      array_push($errors, 'id_coop null or invalid;');
        
        // END VALIDATION BLOCK /////////

    	DB::table('coop_evaluation')
        ->whereNotExists(function ($query) use($id_req) {
                $query->select(DB::raw(1))
                    ->from('coop_evaluation')
                    ->whereRaw('coop_evaluation.id_req = ?', $id_req)
        ->insert([
            'puctual_eval' => $punctual,
            'satisf_eval' => $satisf,
            'observation' => $obs,
            'id_req' => $id_req,
            'id_user_coop' => $id_coop
        ]);
    }

    public static function get_evals_per_coop($id_coop)
    {

        $list = DB::table('coop_evaluation')
                    ->where('id_del', 0)
                    ->where('id_user_coop', $id_coop)
                    ->groupBy('id_user_coop')
                    
        return $list;
    }

}
