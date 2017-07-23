<?php

namespace App\Util\Dao;

use DB;
use App\Util\Utilities;

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
        $str_address = $data['nm_st'] . ', ' . $data['id_st_numb'] . ', ' . $data['nm_city'] . ', ' . $data['nm_state'] . ', ' . $data['nm_country'];
        $lat_lon = Utilities::get_lat_lon($str_address);
        $lat = $lat_lon[0];
        $lon = $lat_lon[1];

        if($is_main_address == 1){
            DB::table('address')
            ->where('id_user', $id_user)
            ->update(['main_address' => 0]);
        }
        DB::table('address')->insert([
                'id_lat' => $lat,
                'id_lon' => $lon,
                'id_comp' =>(int)$data['id_comp'],
                'nm_st' =>$data['nm_st'],
                'id_st_numb'=>$data['id_st_numb'],
                'nm_country'=>$data['nm_country'],
                'nm_state'=>$data['nm_state'],
                'nm_city'=>$data['nm_city'],
                'id_cep'=>$data['id_cep'],
                'str_address'=>$str_address,
                'id_user' => $id_user,
                'main_address' => $is_main_address
            ]);
        $res = 1;

        return $res;
    }
}
