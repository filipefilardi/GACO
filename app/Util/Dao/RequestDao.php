<?php

namespace App\Util\Dao;

use DB;
use App\Util\Utilities;

class RequestDao

// status_req in (PEND, ACPT, COMP, CNCL) Pending, Accepted, Completed, Canceled

{

    public static function get_full_info_dashboard_req_by_user($id_user) // All ACPT or PEND requests
    {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request')
            ->leftJoin('request_assignment', function ($join) {
            $join->on('request.id_req', '=', 'request_assignment.id_req')
                 ->where('request_assignment.id_del', '=', 0);
            })
            ->join('garbage', function ($join) {
            $join->on('request.id_garbage', '=', 'garbage.id_garbage')
                 ->where('garbage.id_del', 0);
            })
            ->select('request.*','request_assignment.dt_predicted', 'garbage.nm_garbage')
            ->where('request.id_user_req', $id_user)
            ->whereIn('request.status_req',['ACPT','PEND'])
            ->where('request.id_del', 0)
            ->distinct()
            ->get();

        return $list;
    }

    public static function get_all_requests_by_user($id_user) // All requests
    {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

    	$list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->get();
        			
        return $list;
    }

    public static function get_actv_requests_by_user($id_user) // Active requests
    {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->get();
                    
        return $list;
    }

    public static function get_pend_requests_by_user($id_user) // Pending requests
    {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->where('status_req', 'PEND')
            ->get();
                    
        return $list;
    }

    public static function get_acpt_requests_by_user($id_user) // Accepted requests
    {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->where('status_req', 'ACPT')
            ->get();
                            
        return $list;
    }

    public static function get_comp_requests_by_user($id_user) // Completed requests but not confirmed
    {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'Y')
            ->where('status_req', 'COMP')
            ->get();
                    
        return $list;
    }


    public static function get_comp_conf_requests_by_user($id_user) // Completed requests and confirmed
    {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'N')
            ->where('status_req', 'COMP')
            ->get();
                    
        return $list;
    }

    public static function get_cncl_requests_by_user($id_user) // Canceled requests
    {

        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_user_req', $id_user)
            ->where('id_active', 'N')
            ->where('status_req', 'CNCL')
            ->get();
                    
        return $list;
    }

    public static function get_pend_requests_for_coop() // Pending requests for coop
    {

        $list = DB::table('request')
            ->where('id_del', 0)
            ->where('id_active', 'Y')
            ->where('status_req', 'PEND')
            ->get();
                    
        return $list;
    }

    public static function get_acpt_requests_by_coop($id_user) // Accepted requests by coop
    {

        $list = DB::table('request_assignment')
            ->join('request', function ($join) {
            $join->on('request_assignment.id_req', '=', 'request.id_req')
                 ->where('request.id_del', 0)
                 ->where('request.id_active', 'Y');
            })
            //->join('request_assignment', 'request.id_req', '=', 'request_assignment.id_req')
            ->where('request_assignment.id_del', 0)
            ->where('request_assignment.id_user_assign', $id_user)
            ->select('request.*','dt_predicted')
            ->get();        
        return $list;
    }

    public static function insert_request($id_garbage, $id_user, $desc_req, $mod_req, $status_garbage, $id_add)
    {

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_garbage)     || $id_garbage <= 0)                    array_push($errors, 'id_garbage null or invalid (<=0)');
        if(is_null($id_user)        || $id_user <= 0)                       array_push($errors, 'id_user null or invalid (<=0)');
        if(is_null($desc_req)       || strlen((string)$desc_req)<=5)        array_push($errors, 'desc_req null or invalid (len<=5)');
        if(is_null($mod_req)        || strlen((string)$mod_req)<=5)         array_push($errors, 'mod_req null or invalid (len<=5)');
        if(is_null($status_garbage) || strlen((string)$status_garbage)<=5)  array_push($errors, 'status_garbage null or invalid (len<=5)');
        if(is_null($id_add)         || $id_add <=0)                         array_push($errors, 'id_add null or invalid (<=0)');

        // END VALIDATION BLOCK /////////

        if(sizeof($errors)>0) return $errors;

        $conf_token = $id_user . substr((string) time(),-3) . Utilities::randomize_dictionary(5);
        $today = date("Ymd");

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
            ->whereExists(function ($query) use($id_add, $id_user) {
                $query->select(DB::raw(1))
                      ->from('address')
                      ->whereRaw('address.id_user = ' . $id_user)
                      ->whereRaw('address.id_add = ' . $id_add)
                      ->whereRaw('address.id_del = ' . 0);
            })
            ->insert([
                'id_garbage' => $id_garbage,
                'id_user_req' => $id_user,
                'desc_req' => $desc_req,
                'status_garbage' => $status_garbage,
                'status_req' => 'PEND',
                'conf_token' => $conf_token,
                'dt_req' =>$today,
                'id_active' => 'Y',
                'mod_req' => $mod_req,
                'id_add' => $id_add
            ]);
      
        return $conf_token;
    }

    public static function update_request($id_req, $new_status_req)
    {

        $status_list = array('PEND', 'ACPT', 'COMP', 'CNCL');

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($new_status_req) || !in_array($new_status_req, $status_list)) 
            array_push($errors, 'new status_req null or invalid;');
        
        // END VALIDATION BLOCK /////////

        if(sizeof($errors)>0) return $errors;

        DB::table('request')
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

    // This is called upon Cooperative accepting the request
    public static function assign_request($id_req, $id_user, $dt_predicted)
    {
        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(is_null($id_req) || $id_req <= 0) array_push($errors, 'id_req null or invalid (<=0)');

        // END VALIDATION BLOCK /////////

        if(sizeof($errors)>0) return $errors;

        DB::table('request_assignment')
            ->whereExists(function ($query) use($id_req) {
                $query->select(DB::raw(1))
                      ->from('request')
                      ->whereRaw('request.id_req = ?', $id_req)
                      ->whereRaw('request.id_active = ?' , 'Y')
                      ->whereRaw('request.status_req = ?', 'PEND')
                      ->whereRaw('request.id_del = ?', 0);
            })
            ->whereExists(function ($query) use($id_user) {
                $query->select(DB::raw(1))
                      ->from('users')
                      ->whereRaw('users.id_user = ?', $id_user)
                      ->whereRaw('users.id_cat = ?', 3) // Has to be a cooperative to accept request 
                      ->whereRaw('users.id_del = ?', 0);
            })
            ->whereNotExists(function ($query) use($id_req) {
                $query->select(DB::raw(1))
                    ->from('request_assignment')
                    ->whereRaw('request_assignment.id_req = ?', $id_req);
            })
            ->insert([
                'id_req' => $id_req,
                'id_user_assign' => $id_user,
                'dt_predicted' => $dt_predicted,
                'id_del' => 0
            ]);
      
        return $errors;
    }

    public static function confirm_request($id_req, $id_user_auth, $conf_token)
    {
        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_user_auth)   || $id_user_auth <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(is_null($id_req)         || $id_req <= 0) array_push($errors, 'id_req null or invalid (<=0)');
        if(is_null($conf_token)     || strlen($conf_token) < 9) array_push($errors, 'id_req null or invalid (<=0)');

        // END VALIDATION BLOCK /////////

        if(sizeof($errors)>0) return $errors;

        $id_cat = -1;
        $id_cat = DB::table('users')
            ->whereExists(function ($query) use($id_user_auth) {
                $query->select(DB::raw(1))
                      ->from('users')
                      ->whereRaw('users.id_user = ?', $id_user_auth)
                      ->whereRaw('users.id_del = ?', 0);
                })      
            ->where('id_user',$id_user_auth)
            ->value('id_cat');

        if($id_cat <=3) {        // Master users or invalid cat cannot confirm reqs

            $today = date("Ymd");
                
            DB::table('request_confirmation')
                ->whereExists(function ($query) use($id_req, $conf_token) {
                $query->select(DB::raw(1))
                    ->from('request')
                    ->whereRaw('request.id_req = ?', $id_req)
                    ->whereRaw('request.id_del = ?', 0)
                    ->whereRaw('request.conf_token = ?', $conf_token);
                })
                ->where('id_req', $id_req)
                ->update([
                    'id_sign' => 'Y',
                    'dt_sign' => $today
                ]);
        }

        return $errors;
    }

}
