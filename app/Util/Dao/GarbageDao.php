<?php

namespace App\Util\Dao;

use DB;

class GarbageDao

{

    public static function get_list_garbage_by_name()
    {

    	$list = DB::table('garbage')
            ->where('id_del', 0)
            ->pluck('nm_garbage');
        			
        return $list;
    }

    public static function get_list_garbage_actv()
    {

        $list = DB::table('garbage')->where('id_del', 0)->get();
                    
        return $list;
    }

    public static function get_list_garbage() // Active and inactive
    {

        $list = DB::table('garbage')->get();
                    
        return $list;
    }

    public static function delete_garbage($id_garbage)
    {

        DB::table('garbage')
            ->whereExists(function ($query) use($id_garbage) {
                $query->select(DB::raw(1))
                      ->from('garbage')
                      ->whereRaw('garbage.id_garbage = ' . $id_garbage)
                      ->whereRaw('garbage.id_del = ' . 0);
            })
            ->where('id_garbage', $id_garbage)
            ->update(['id_del' => 1]);
      
        return;
    }

        public static function activate_garbage($id_garbage)
    {

        DB::table('garbage')
            ->whereExists(function ($query) use($id_garbage) {
                $query->select(DB::raw(1))
                      ->from('garbage')
                      ->whereRaw('garbage.id_garbage = ' . $id_garbage)
                      ->whereRaw('garbage.id_del = ' . 1);
            })
            ->where('id_garbage', $id_garbage)
            ->update(['id_del' => 0]);
      
        return;
    }

}
