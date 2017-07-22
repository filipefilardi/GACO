<?php

namespace App\Util\Dao;

use DB;

class AddressDao

{
    
    public static function getAddresses($id_user)
    {
        
        $res = DB::table('address')
        ->where('id_user', $id_user)
        ->where('id_del', 0)
        ->get();


        return $res;
    }


    /*Insert a new address and update the other addresses if the current one is the main address*/
    public static function insertAndUpdateAddress($id_user, $data)
    {
        $is_main_address = (int)$data['main_address'];

        if($is_main_address == 1){
            DB::table('address')
            ->where('id_user', $id_user)
            ->update(['main_address' => 0]);
        }
        DB::table('address')->insert([
                'id_lat' => 0,
                'id_lon' => 0,
                'id_comp' =>(int)$data['id_comp'],
                'nm_st' =>$data['nm_st'],
                'id_st_numb'=>$data['id_st_numb'],
                'nm_country'=>$data['nm_country'],
                'nm_city'=>$data['nm_city'],
                'id_cep'=>$data['id_cep'],
                'id_user' => $id_user,
                'main_address' => $is_main_address
            ]);
        $res = 1;

        return $res;
    }
}
