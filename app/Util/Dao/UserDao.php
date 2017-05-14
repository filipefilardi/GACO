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

    public static function insert($id_user, $data)
    {

        $table->increments('id_add');
            $table->float('id_lat');
            $table->float('id_lon');
            $table->string('id_comp');
            $table->string('nm_st');
            $table->string('id_st_numb'); // maybe int
            $table->string('nm_country');
            $table->string('nm_city');
            $table->string('id_cep');

            DB::table('address')->insert([
                'id_lat' => 0,
                'id_lon' => 0,
                'id_comp' =>(int)$data['id_comp'],
                'nm_st' =>$data['nm_st'],
                'id_st_numb'=>$data['id_st_numb'],
                'nm_country'=>$data['nm_country'],
                'nm_city'=>$data['nm_city'],
                'id_cep'=>$data['id_cep'],
            ]);


        $id_add = DB::table('address')->where('id', DB::raw("(select max(`id`) from orders)"))->get();
        switch ($id_cat) {
                    case 1:

                        DB::table('user_person')->insert([
                            'id_user' => $id_user,
                            'nm_user' => $data['nm_user'],
                            'dt_user' => $data['dt_user'],
                            'ph_mob' => $data['ph_mob'],
                            'ph_res' => $data['ph_res'],
                            'cpf_user' => $data['cpf_user'],
                            'id_add' => $id_add,
                        ]);

                        break;
                    
                    case 2:

                        DB::table('user_enterprise')->insert([
                            'id_user' => $id_user,
                            'nm_user' => $data['nm_user'],
                            'ph_corp' => $data['ph_corp'],
                            'cnpj_user' => $data['cnpj_user'],
                            'id_add' => $id_add,
                        ]);


                        break;
                    
                    default:
                        $res = null;
                        break;
                }

        return $res;
    }

}
