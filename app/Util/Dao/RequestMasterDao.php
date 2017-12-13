<?php

namespace App\Util\Dao;

use DB;
use App\Util\Utilities;

class RequestMasterDao {

// status_req in (PEND, ACPT, COMP, CNCL) Pending, Accepted, Completed, Canceled


    public static function insert_request($id_user, $id_garbage, $state, $observation, $id_add, $quantity, $desc_req, $tx_weekdays,$tx_period_day)
    {
        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_user)        || $id_user <= 0)                       array_push($errors, 'id_user null or invalid (<=0)');
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

    public static function get_master_by_user_conditional($id_user, $where_key, $where_comparison, $where_value) {
        $errors = array();
        if(is_null($id_user) || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');
        if(sizeof($errors)>0) return $errors;

        $list = DB::table('request_master')
            ->join('address', function ($join){
                $join->on('address.id_add', '=', 'request_master.id_add')
                 ->where('address.id_del', 0);
            })
            ->leftJoin('request_assignment', function ($join) {
            $join->on('request_master.id_req_master', '=', 'request_assignment.id_req_master')
                 ->where('request_assignment.id_del', '=', 0);
            })
            ->leftJoin('request_postpone', function ($join) {
            $join->on('request_master.id_req_master', '=', 'request_postpone.id_req_master')
                 ->where('request_postpone.id_active', '=', 'Y');
            })
            // ->leftJoin('request_postpone', function ($join) {
            // $join->on('request_assignment.id_assign', '=', 'request_postpone.id_assign')
            //      ->where('request_postpone.id_active', '=', 'Y')
            //      ->where('request_postpone.id_del', '=', 0);
            // })
            ->leftJoin('coop_evaluation', function ($join) {
            $join->on('request_master.id_req_master', '=', 'coop_evaluation.id_req_master')
                 ->where('coop_evaluation.id_del', '=', 0);
            })
            ->select('request_master.*','address.str_address','request_assignment.dt_predicted','request_assignment.period_predicted','request_postpone.tx_justification', 'coop_evaluation.id_eval', 'request_assignment.fl_user_confirm')
            ->where('request_master.id_user_req', $id_user)
            ->whereIn('request_master.status_req',['ACPT','PEND','COMP'])
            ->where('request_master.id_del', 0)
            ->where($where_key,$where_comparison,$where_value)
            ->distinct()
            ->orderBy('id_req_master')
            #->toSql();
            ->get();

            #dd($list);

        return $list;
    }

    public static function get_master_conditional($where_key, $where_comparison, $where_value) {

        $list = DB::table('request_master')
            ->join('address', function ($join){
                $join->on('address.id_add', '=', 'request_master.id_add')
                 ->where('address.id_del', 0);
            })
            ->leftJoin('request_assignment', function ($join) {
            $join->on('request_master.id_req_master', '=', 'request_assignment.id_req_master')
                 ->where('request_assignment.id_del', '=', 0);
            })
            ->leftJoin('request_postpone', function ($join) {
            $join->on('request_master.id_req_master', '=', 'request_postpone.id_req_master')
                 ->where('request_postpone.id_active', '=', 'Y');
            })
            // ->leftJoin('request_postpone', function ($join) {
            // $join->on('request_assignment.id_assign', '=', 'request_postpone.id_assign')
            //      ->on('request_master.id_req_master', '=', 'request_postpone.id_req_master')
            //      ->where('request_postpone.id_active', '=', 'Y')
            //      ->where('request_postpone.id_del', '=', 0);
            // })
            ->select('request_master.*','address.str_address','request_assignment.dt_predicted','request_assignment.period_predicted','request_postpone.tx_justification', 'request_assignment.fl_user_confirm')
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
                $join->on('request_assignment.id_req_master', '=', 'request_master.id_req_master')
                ->where('request_assignment.id_user_assign', $id_user)
                ->where('request_assignment.id_del', 0);
            })
            ->leftJoin('request_postpone', function ($join) {
            $join->on('request_master.id_req_master', '=', 'request_postpone.id_req_master')
                 ->where('request_postpone.id_active', '=', 'Y')
                 ->where('request_postpone.id_del', '=', 0);
            })
            // ->leftJoin('request_postpone', function ($join) use($id_user) {
            // $join->on('request_assignment.id_assign', '=', 'request_postpone.id_assign')
            //      ->on('request_master.id_req_master', '=', 'request_postpone.id_req_master')
            //      ->where('request_postpone.id_active', '=', 'Y')
            //      ->where('request_postpone.id_del', '=', 0);
            // })
            ->select('request_master.*','address.str_address', 'request_assignment.dt_predicted','request_assignment.period_predicted','request_postpone.tx_justification', 'request_assignment.fl_user_confirm')
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
        if(is_null($id_req_master)  || $id_req_master <= 0) array_push($errors, 'id_req_master null or invalid (<=0)');        
        
        // END VALIDATION BLOCK /////////

        if(sizeof($errors)>0) return $errors;

        DB::table('request_master')
            ->whereExists(function ($query) use($id_req_master, $new_status_req) {
                $query->select(DB::raw(1))
                      ->from('request_master')
                      ->whereRaw('request_master.id_req_master = ?', $id_req_master)
                      ->whereRaw('request_master.id_active = ?','Y')
                      ->whereRaw('request_master.status_req != ?','COMP') // Cannot update completed requests
                      ->whereRaw('request_master.status_req != ?', $new_status_req)
                      ->whereRaw('request_master.id_del = ?', 0);
            })
            ->where('id_req_master', $id_req_master)
            ->update([
                'status_req' => $new_status_req
            ]);

        return $errors;
    }

    public static function cancel_master_request($id_req_master,$id_cat) {

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_req_master)  || $id_req_master <= 0) array_push($errors, 'id_req_master null or invalid (<=0)');        
        
        if(sizeof($errors)>0) return $errors;
        // END VALIDATION BLOCK /////////

        if($id_cat == 1 || $id_cat == 2)    $errors = RequestMasterDao::update_master_request($id_req_master,'CNCL');
        if($id_cat == 3)                    $errors = RequestMasterDao::update_master_request($id_req_master,'PEND');

        return $errors;
    }

    public static function accept_master_request($id_req_master, $id_user, $dt_predicted, $period_predicted) {

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_req_master)  || $id_req_master <= 0) array_push($errors, 'id_req_master null or invalid (<=0)');
        if(is_null($id_user)        || $id_user <= 0)       array_push($errors, 'id_user null or invalid (<=0)');        
        
        if(sizeof($errors)>0) return $errors;
        // END VALIDATION BLOCK /////////

        if ($dt_predicted != null && strlen($dt_predicted) > 8) {
            $tmp = explode("/",$dt_predicted);
            $dt_predicted = $tmp[2] .  $tmp[1]  . $tmp[0];
        }

        DB::table('request_assignment')
            ->whereExists(function ($query) use($id_req_master) {
                $query->select(DB::raw(1))
                      ->from('request_master')
                      ->whereRaw('request_master.id_req_master = ?', $id_req_master)
                      ->whereRaw('request_master.id_active = ?' , 'Y')
                      ->whereRaw('request_master.status_req = ?', 'PEND')
                      ->whereRaw('request_master.id_del = ?', 0);
            })
            ->whereExists(function ($query) use($id_user) {
                $query->select(DB::raw(1))
                      ->from('users')
                      ->whereRaw('users.id_user = ?', $id_user)
                      ->whereRaw('users.id_cat = ?', 3) // Has to be a cooperative to accept request 
                      ->whereRaw('users.id_del = ?', 0);
            })
            ->whereNotExists(function ($query) use($id_req_master) {
                $query->select(DB::raw(1))
                    ->from('request_assignment')
                    ->whereRaw('request_assignment.id_del = ?', 0)
                    ->whereRaw('request_assignment.id_req_master = ?', $id_req_master);
            })
            ->insert([
                'id_req_master' => $id_req_master,
                'id_user_assign' => $id_user,
                'dt_predicted' => $dt_predicted,
                'period_predicted' => $period_predicted,
                'id_del' => 0
            ]);

        return $errors;
    }

    public static function confirm_master_request($id_req_master, $id_user, $id_cat, $conf_token, $dt_collect) {

        $tmp = explode("/",$dt_collect);
        $dt_collect = $tmp[2] .  $tmp[1]  . $tmp[0];

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_user)        || $id_user <= 0)           array_push($errors, 'id_user null or invalid (<=0)');
        if(is_null($id_req_master)  || $id_req_master <= 0)     array_push($errors, 'id_req_master null or invalid (<=0)');
        if(is_null($conf_token)     || strlen($conf_token) < 9) array_push($errors, 'conf_token null or invalid');

        if(sizeof($errors)>0) return $errors;

        $conf_token_db = DB::table('request_master')
                            ->where('id_del', 0)
                            ->where('id_active', 'Y')
                            ->where('id_req_master', $id_req_master)
                            ->where('status_req', 'ACPT')
                            ->value('conf_token');

        if($conf_token_db != $conf_token) array_push($errors,'Seu token de confirmação está incorreto!');

        if(sizeof($errors)>0) return $errors;

        // END VALIDATION BLOCK /////////

        if($id_cat == 3) {        // Master users or invalid cat cannot confirm reqs

            $today = date("Ymd");
            
            DB::table('request_master')
                ->whereExists(function ($query) use($id_req_master, $conf_token) {
                $query->select(DB::raw(1))
                    ->from('request_master')
                    ->whereRaw('request_master.id_req_master = ?', $id_req_master)
                    ->whereRaw('request_master.id_del = ?', 0)
                    ->whereRaw('request_master.conf_token = ?', $conf_token);
                })
                ->whereExists(function ($query) use($id_req_master, $id_user) {
                $query->select(DB::raw(1))
                    ->from('request_assignment')
                    ->whereRaw('request_assignment.id_req_master = ?', $id_req_master)
                    ->whereRaw('request_assignment.id_user_assign = ?', $id_user)
                    ->whereRaw('request_assignment.id_del = ?', 0);
                })
                ->whereExists(function ($query) use($id_req_master, $id_user) {
                $query->select(DB::raw(1))
                    ->from('request_confirmation')
                    ->whereRaw('request_confirmation.id_req_master = ?', $id_req_master)
                    ->whereRaw('request_confirmation.id_sign = ?', 'N')
                    ->whereRaw('request_confirmation.id_del = ?', 0);
                })
                ->where('id_req_master', $id_req_master)
                ->update([
                    'dt_collect' => $dt_collect,
                ]);

            $affected = DB::table('request_confirmation')
                ->whereExists(function ($query) use($id_req_master, $conf_token) {
                $query->select(DB::raw(1))
                    ->from('request_master')
                    ->whereRaw('request_master.id_req_master = ?', $id_req_master)
                    ->whereRaw('request_master.id_del = ?', 0)
                    ->whereRaw('request_master.conf_token = ?', $conf_token);
                })
                ->whereExists(function ($query) use($id_req_master, $id_user) {
                $query->select(DB::raw(1))
                    ->from('request_assignment')
                    ->whereRaw('request_assignment.id_req_master = ?', $id_req_master)
                    ->whereRaw('request_assignment.id_user_assign = ?', $id_user)
                    ->whereRaw('request_assignment.id_del = ?', 0);
                })
                ->where('id_req_master', $id_req_master)
                ->update([
                    'id_sign' => 'Y',
                    'dt_sign' => $today
                ]);
        }

        if($affected == 0) array_push($errors,'Nenhuma coleta confirmada');

        return $errors;
    }

    public static function postpone_request($id_req_master, $id_user, $id_cat, $dt_push, $period_predicted, $tx_justification) {
        
        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_req_master)  || $id_req_master <= 0) array_push($errors, 'id_req_master null or invalid (<=0)');
        if(is_null($id_user)        || $id_user <= 0)       array_push($errors, 'id_user null or invalid (<=0)');        
        if(is_null($id_cat)         || $id_cat <= 0)        array_push($errors, 'id_cat null or invalid (<=0)');

        if(sizeof($errors)>0) return $errors;
        // END VALIDATION BLOCK /////////

        $today = date("Ymd");

        if($id_cat == 1 || $id_cat == 2) {

            RequestMasterDao::update_master_request($id_req_master,'PEND');
            $dt_push = null;
            $period_predicted = null;
            $id_assign = null;

        } elseif ($id_cat == 3) {
            
            $tmp = explode("/",$dt_push);
            $dt_push = $tmp[2] .  $tmp[1]  . $tmp[0];

            RequestMasterDao::update_master_request($id_req_master,'PEND');
            RequestMasterDAO::accept_master_request($id_req_master,$id_user, $dt_push, $period_predicted);

        }

        DB::table('request_postpone')
            ->whereExists(function ($query) use($id_req_master) {
                $query->select(DB::raw(1))
                      ->from('request_master')
                      ->whereRaw('request_master.id_req_master = ?', $id_req_master)
                      ->whereRaw('request_master.id_req_master = ?', $id_req_master)
                      ->whereRaw('request_master.id_active = ?','Y')
                      ->whereRaw('request_master.status_req in (?,?)',['PEND','ACPT'])
                      ->whereRaw('request_master.id_del = ?', 0);
            })
            ->insert([
                'id_req_master' => $id_req_master,
                'id_user_post' => $id_user,
                'dt_postpone' => $today,
                'dt_push' => $dt_push,
                'period_push' => $period_predicted,
                'id_active' => 'Y',
                'tx_justification' => $tx_justification,
                'id_del' => 0
            ]);
    }

    public static function get_token_by_request($id_req_master) {
        
        $res = DB::table('request_master')
                        ->where('id_req_master', $id_req_master)
                        ->get();

        return $res;
    }

    public static function user_reply_assignment($id_req_master,$conf_token,$id_user,$id_cat,$id_choice) {

        // VALIDATION BLOCK //////////////
        $errors = array();

        if(is_null($id_req_master)  || $id_req_master <= 0) array_push($errors, 'id_req_master null or invalid (<=0)');
        if(is_null($id_user)  || $id_user <= 0) array_push($errors, 'id_user null or invalid (<=0)');        
        if(is_null($conf_token)     || strlen($conf_token) < 9) array_push($errors, 'conf_token null or invalid');
        
        if(sizeof($errors)>0) return $errors;
        // END VALIDATION BLOCK /////////
        if($id_cat == 1 || $id_cat == 2) {

            if($id_choice == 'Y') $decision_flag = 'Y';
            elseif($id_choice == 'N') $decision_flag = 'N';

            DB::table('request_assignment')
            ->whereExists(function ($query) use($id_req_master, $conf_token) {
                $query->select(DB::raw(1))
                      ->from('request_master')
                      ->whereRaw('request_master.id_req_master = ?', $id_req_master)
                      ->whereRaw('request_master.conf_token = ?', $conf_token)
                      ->whereRaw('request_master.id_active = ?' , 'Y')
                      ->whereRaw('request_master.status_req = ?', 'ACPT')
                      ->whereRaw('request_master.id_del = ?', 0);
            })
            ->whereExists(function ($query) use($id_user) {
                $query->select(DB::raw(1))
                      ->from('users')
                      ->whereRaw('users.id_user = ?', $id_user)
                      ->whereRaw('users.id_cat in (?,?)', [1,2])
                      ->whereRaw('users.id_del = ?', 0);
            })
            ->where(function ($query) use($id_req_master) {
                $query->select(DB::raw(1))
                    ->from('request_assignment')
                    ->whereRaw('request_assignment.id_del = ?', 0)
                    ->whereRaw('request_assignment.id_req_master = ?', $id_req_master);
            })
            ->update([
                'fl_user_confirm' => $decision_flag
            ]);

            if($decision_flag == 'N') RequestMasterDao::postpone_request($id_req_master,$id_user, $id_cat, null, null, $tx_justification);

        }
        else array_push($errors, 'user does not have permission to confirm assignment');

        return $errors;
    }
}
