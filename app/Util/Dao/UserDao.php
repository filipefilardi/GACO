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

    public static function insert($id_user, $data, $id_cat)
    {

        switch ($id_cat) {
                    case 1:

                        DB::table('user_person')->insert([
                            'id_user' => $id_user,
                            'nm_user' => $data['name'],
                            'dt_user' => $data['birth'],
                            'ph_mob' => $data['mobile_phone'],
                            'ph_res' => $data['home_phone'],
                            'cpf_user' => $data['cpf']

                        ]);
                        $res=1;
                        break;
                    
                    case 2:

                        DB::table('user_enterprise')->insert([
                            'id_user' => $id_user,
                            'nm_user' => $data['name'],
                            'ph_corp' => $data['corp_phone'],
                            'cnpj_user' => $data['cnpj']
                        ]);


                        $res=1;
                        break;

                    case 3:

                        DB::table('user_cooperative')->insert([
                            'id_user' => $id_user,
                            'nm_user' => $data['name'],
                            'ph_corp' => $data['corp_phone'],
                            'id_radius_user' => $data['id_radius_user'],
                            'cnpj_user' => $data['cnpj']
                        ]);


                        $res=1;
                        break;
                    
                    default:
                        $res = null;
                        break;
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
                'main_address' => 1
            ]);


        //$id_add = DB::table('address')->orderBy('id_add', 'desc')->first()->id_add;

        return $res;
    }

}
