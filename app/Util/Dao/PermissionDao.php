<?php

namespace App\Util\Dao;

use DB;

class PermissionDao

{
    
    public static function getPermissionByCat($id_cat,$nm_perm)
    {
        
        $res = DB::table('permission')
        ->where('id_cat', $id_cat)
        ->where('nm_perm', $nm_perm)
        ->get();


        return $res;
    }

}
