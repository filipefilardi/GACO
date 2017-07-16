<?php

namespace App\Util\Dao;

use DB;

class AddressDao

{
    
    public static function getAddresses($id_user)
    {
        
        $res = DB::table('address')
        ->where('id_user', $id_user)
        ->get();


        return $res;
    }
    /*



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
                'main_address' => 1
            ]);
            
    */
}
