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
            ->join('address', function ($join){
                $join->on('address.id_add', '=', 'request.id_add')
                 ->where('address.id_del', 0);
            })
            ->select('request.*','request_assignment.dt_predicted', 'garbage.nm_garbage','address.str_address')
            ->where('request.id_user_req', $id_user)
            ->whereIn('request.status_req',['ACPT','PEND'])
            ->where('request.id_del', 0)
            ->distinct()
            ->orderBy('id_req')
            ->get();

        return $list;
    }

}
