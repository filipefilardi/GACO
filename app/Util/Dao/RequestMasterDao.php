<?php

namespace App\Util\Dao;

use DB;
use App\Util\Utilities;

class RequestMasterDao {

// status_req in (PEND, ACPT, COMP, CNCL) Pending, Accepted, Completed, Canceled


    public static function insert_request($id_user, $id_garbage, $state, $observation, $id_add, $quantity, $desc_req, $tx_period_day, $tx_weekdays)
    {
        // VALIDATION BLOCK //////////////
        $errors = array();

        #if(is_null($id_garbage)     || $id_garbage <= 0)                    array_push($errors, 'id_garbage null or invalid (<=0)');
        if(is_null($id_user)        || $id_user <= 0)                       array_push($errors, 'id_user null or invalid (<=0)');
        #if(is_null($observation)       || strlen((string)$observation)<=5)        array_push($errors, 'observation null or invalid (len<=5)');
        #if(is_null($mod_req)        || strlen((string)$mod_req)<=5)         array_push($errors, 'mod_req null or invalid (len<=5)');
        #if(is_null($status_tv) || strlen((string)$status_tv)<=5)  array_push($errors, 'status_tv null or invalid (len<=5)');
        if(is_null($id_add)         || $id_add <=0)                         array_push($errors, 'id_add null or invalid (<=0)');

        // END VALIDATION BLOCK /////////
        
        if(sizeof($errors)>0) return $errors;
        
        $conf_token = $id_user . substr((string) time(),-3) . Utilities::randomize_dictionary(5);
        $today = date("Ymd");
        
        $insert = array('id_user_req' => $id_user,'status_req' => 'PEND','conf_token' => $conf_token,'tx_weekdays' => $tx_weekdays,'tx_period_day' => $tx_period_day, 'dt_req' =>$today,'id_active' => 'Y','id_add' => $id_add);

        $id = DB::table('request_master')
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
        ->insertGetId($insert, 'id_req_master');
        
        $res = (string) ($conf_token . '-' . $id);

        return $res;
    }

    public static function postpone_request($id_req_master) {

    }

    public static function get_master_by_user_conditional($id_user, $where_key, $where_comparison, $where_value) {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request_master')
            ->join('address', function ($join){
                $join->on('address.id_add', '=', 'request_master.id_add')
                 ->where('address.id_del', 0);
            })
            ->select('request_master.*','address.str_address')
            ->where('request_master.id_user_req', $id_user)
            ->whereIn('request_master.status_req',['ACPT','PEND'])
            ->where('request_master.id_del', 0)
            ->where($where_key,$where_comparison,$where_value)
            ->distinct()
            ->orderBy('id_req_master')
            ->get();

        return $list;
    }

    public static function get_master_conditional($where_key, $where_comparison, $where_value) {

        $list = DB::table('request_master')
            ->join('address', function ($join){
                $join->on('address.id_add', '=', 'request_master.id_add')
                 ->where('address.id_del', 0);
            })
            ->select('request_master.*','address.str_address')
            ->whereIn('request_master.status_req',['ACPT','PEND'])
            ->where('request_master.id_del', 0)
            ->where($where_key,$where_comparison,$where_value)
            ->distinct()
            ->orderBy('id_req_master')
            ->get();

        return $list;
    }

    public static function get_master_acpt_by_coop($id_user) {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request_master')
            ->join('address', function ($join){
                $join->on('address.id_add', '=', 'request_master.id_add')
                ->where('address.id_del', 0);
            })
            ->join('request_assignment', function ($join) use($id_user) {
                $join->on('request_assignment.id_req_master', '=', 'request_assignment.id_req_master')
                ->where('request_assignment.id_user_assign', $id_user)
                ->where('request_assignment.id_del', 0);
            })
            ->select('request_master.*','address.str_address')
            ->where('request_master.id_user_req', $id_user)
            ->whereIn('request_master.status_req',['ACPT'])
            ->where('request_master.id_del', 0)
            ->distinct()
            ->orderBy('id_req_master')
            ->get();

        return $list;
    }

    public static function update_master_request($id_req_master, $new_status_req) {

        $status_list = array('PEND', 'ACPT', 'COMP', 'CNCL');

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($new_status_req) || !in_array($new_status_req, $status_list)) array_push($errors, 'new status_req null or invalid;');
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');        
        
        // END VALIDATION BLOCK /////////

        if(sizeof($errors)>0) return $errors;

        DB::table('request_master')
            ->whereExists(function ($query) use($id_req, $new_status_req) {
                $query->select(DB::raw(1))
                      ->from('request')
                      ->whereRaw('request.id_req = ?', $id_req)
                      ->whereRaw('request.id_active = ?','Y')
                      ->whereRaw('request.status_req != ?','COMP') // Cannot update completed requests
                      ->whereRaw('request.status_req != ?', $new_status_req)
                      ->whereRaw('request.id_del = ?', 0);
            })
            ->where('id_req', $id_req)
            ->update([
                'status_req' => $new_status_req
            ]);

        return $errors;
    }
}
