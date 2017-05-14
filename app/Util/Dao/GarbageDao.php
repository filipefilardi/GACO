<?php

namespace App\Util\Dao;

use DB;

class GarbageDao

{

    public function get_list_garbage_by_name()
    {

    	$list = DB::table('garbage')->where('id_del', 0)->value('nm_garbage');
        			
        return $list;
    }

    public function makeRequest(Request $request)
    {
    	$user_id_code = Auth::user()->id_code;

    	echo Auth::user()->id_code;
    	echo " requests: ";
    	echo $request->input("id_code");

    	$customer_id_code = $request->input("id_code");

    	DB::table('requests')->insert([
            ['user_id_code' => $user_id_code,
            'customer_id_code' => $customer_id_code,
            ]

        ]);
    }
}
