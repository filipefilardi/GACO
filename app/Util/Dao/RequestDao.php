<?php

namespace App\Util\Dao;

use DB;

class RequestDao

// status_req in (PEND, ACPT, COMP, CNCL) Pending, Accepted, Completed, Canceled

{

    public static function get_all_requests_by_user($id_user) // All requests
    {
    	$list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->get();
        			
        return $list;
    }

    public static function get_actv_requests_by_user($id_user) // Active requests
    {
        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->get();
                    
        return $list;
    }

    public static function get_pend_requests_by_user($id_user) // Pending requests
    {
        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->where('status_req', 'PEND')
            ->get();
                    
        return $list;
    }

    public static function get_pend_requests_by_user($id_user) // Accepted requests
    {
        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->where('status_req', 'ACPT')
            ->get();
                    
        return $list;
    }

    public static function get_pend_requests_by_user($id_user) // Completed requests
    {
        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->where('status_req', 'COMP')
            ->get();
                    
        return $list;
    }


    public static function get_pend_requests_by_user($id_user) // Canceled requests
    {
        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->where('status_req', 'CNCL')
            ->get();
                    
        return $list;
    }

    public static function insert_request($id_garbage, $id_user, $desc_req, $mod_req, $status_garbage)
    {
        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_garbage)     || $id_garbage <= 0)                    array_push($errors, 'id_garbage null or invalid (<=0);');
        if(is_null($id_user)        || $id_user <= 0)                       array_push($errors, 'id_user null or invalid (<=0);');
        if(is_null($desc_req)       || strlen((string)$desc_req)<=5)        array_push($errors, 'desc_req null or invalid (len<=5);');
        if(is_null($mod_req)        || strlen((string)$mod_req)<=5)         array_push($errors, 'mod_req null or invalid (len<=5);');
        if(is_null($status_garbage) || strlen((string)$status_garbage<=5)   array_push($errors, 'status_garbage null or invalid (len<=5)');

        // END VALIDATION BLOCK /////////

        if(sizeof($errors)>0) return $errors

        DB::table('request')
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
            ->insert([
                'id_garbage' => $id_garbage,
                'id_user_req' => $id_user,
                'desc_req' => $desc_req,
                'mod_req' => $mod_req, 
                'status_garbage' => $status_garbage
            ]);
      
        return;
    }

    public static function insert_request($id_garbage, $id_user, $desc_req, $mod_req, $status_garbage)
    {
        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_garbage)     || $id_garbage <= 0)                    array_push($errors, 'id_garbage null or invalid (<=0);');
        if(is_null($id_user)        || $id_user <= 0)                       array_push($errors, 'id_user null or invalid (<=0);');
        if(is_null($desc_req)       || strlen((string)$desc_req)<=5)        array_push($errors, 'desc_req null or invalid (len<=5);');
        if(is_null($mod_req)        || strlen((string)$mod_req)<=5)         array_push($errors, 'mod_req null or invalid (len<=5);');
        if(is_null($status_garbage) || strlen((string)$status_garbage<=5)   array_push($errors, 'status_garbage null or invalid (len<=5)');

        // END VALIDATION BLOCK /////////

        if(sizeof($errors)>0) return $errors

        DB::table('request')
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
            ->insert([
                'id_garbage' => $id_garbage,
                'id_user_req' => $id_user,
                'desc_req' => $desc_req,
                'mod_req' => $mod_req, 
                'status_garbage' => $status_garbage
            ]);
      
        return;
    }

}
