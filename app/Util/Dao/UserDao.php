<?php

namespace App\Util\Dao;

use DB;

class UserDao

{
    
    public static function getInfo($id_user, $id_cat)
    {
        switch ($id_cat) {
                    case 1:
                        $res = DB::table('user_person')
                        ->where('id_user', $id_user)
                        ->get();
                        break;
                    
                    case 2:
                        $res = DB::table('user_enterprise')
                        ->where('id_user', $id_user)
                        ->get();
                        break;
                    
                    case 3:
                        $res = DB::table('user_cooperative')
                        ->where('id_user', $id_user)
                        ->get();
                        break;
                    
                    case 4:
                        $res = DB::table('user_master')
                        ->where('id_user', $id_user)
                        ->get();
                        break;
                    
                    default:
                        $res = null;
                        break;
                }

        return $res;
    }

}
