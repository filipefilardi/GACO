<?php

namespace App\Util\Dao;

use DB;

class GarbageDao

{

    public function get_list_garbage_by_name()
    {

    	$list = DB::table('garbage')->where('id_del', 0)->pluck('nm_garbage');
        			
        return $list;
    }

    public function get_list_garbage_actv()
    {

        $list = DB::table('garbage')->where('id_del', 0)->get();
                    
        return $list;
    }

    public function get_list_garbage() // Active and inactive
    {

        $list = DB::table('garbage')->get();
                    
        return $list;
    }

}
