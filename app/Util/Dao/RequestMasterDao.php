<?php

namespace App\Util\Dao;

use DB;
use App\Util\Utilities;

class RequestMasterDao {

// status_req in (PEND, ACPT, COMP, CNCL) Pending, Accepted, Completed, Canceled


    public static function insert_request($id_user, $id_garbage, $state, $observation, $id_add, $quantity, $desc_req)
    {
        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_garbage)     || $id_garbage <= 0)                    array_push($errors, 'id_garbage null or invalid (<=0)');
        if(is_null($id_user)        || $id_user <= 0)                       array_push($errors, 'id_user null or invalid (<=0)');
        #if(is_null($observation)       || strlen((string)$observation)<=5)        array_push($errors, 'observation null or invalid (len<=5)');
        #if(is_null($mod_req)        || strlen((string)$mod_req)<=5)         array_push($errors, 'mod_req null or invalid (len<=5)');
        #if(is_null($status_tv) || strlen((string)$status_tv)<=5)  array_push($errors, 'status_tv null or invalid (len<=5)');
        if(is_null($id_add)         || $id_add <=0)                         array_push($errors, 'id_add null or invalid (<=0)');

        // END VALIDATION BLOCK /////////
        
        if(sizeof($errors)>0) return $errors;
        
        $conf_token = $id_user . substr((string) time(),-3) . Utilities::randomize_dictionary(5);
        $today = date("Ymd");

        
        DB::table('request_master')
        ->whereExists(function ($query) use($id_garbage) {
            $query->select(DB::raw(1))
                  ->from('garbage')
                  ->whereRaw('garbage.id_garbage = ' . $id_garbage)
                  ->whereRaw('garbage.id_del = ' . 0);
        })
        ->whereExists(function ($query) use($id_user) {
            $query->select(DB::raw(1))
                  ->from('users')
                  ->whereRaw('users.id_user = ' . $id_user)
                  ->whereRaw('users.id_cat in (1,2)') // Client PF ou PJ 
                  ->whereRaw('users.id_del = ' . 0);
        })
        ->whereExists(function ($query) use($id_add, $id_user) {
            $query->select(DB::raw(1))
                  ->from('address')
                  ->whereRaw('address.id_user = ' . $id_user)
                  ->whereRaw('address.id_add = ' . $id_add)
                  ->whereRaw('address.id_del = ' . 0);
        })
        ->insert([
            //'id_garbage' => $id_garbage,
            'id_user_req' => $id_user,
            //'observation' => $observation,
            //'state' => $state,
            //'desc_req' => $desc_req,
            //'quantity' => $quantity,
            'status_req' => 'PEND',
            'conf_token' => $conf_token,
            'dt_req' =>$today,
            'id_active' => 'Y',
            'id_add' => $id_add
        ]);
        
        return $conf_token;
    }
}
