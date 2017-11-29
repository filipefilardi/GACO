<?php

namespace App\Util\Dao;

use DB;
use App\User;

class UserDao

{
    
    public static function getIdByEmail($email){
        $res = DB::table('users')
                        ->where('email', $email)
                        ->get();
         return $res;               
    }

    public static function getListUsersByCat($id_cat)
    {
        switch ($id_cat) {
                    case 1:
                        $res = DB::table('user_person')
                        ->where('id_del', 0)
                        ->get();
                        break;
                    
                    case 2:
                        $res = DB::table('user_enterprise')
                        ->where('id_del', 0)
                        ->get();
                        break;
                    
                    case 3:
                        $res = DB::table('user_cooperative')
                        ->where('id_del', 0)
                        ->get();
                        break;
                    
                    case 4:
                        $res = DB::table('user_master')
                        ->where('id_del', 0)
                        ->get();
                        break;
                    
                    default:
                        $res = null;
                        break;
                }

        return $res;
    }

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
                        $res = array();
                        break;
                }

        return $res;
    }

    public static function insert($id_user, $data, $id_cat)
    {

        try{
            switch ($id_cat) {
                    case 1:
                        $data['mobile_phone'] = preg_replace("/[^0-9]/", "", $data['mobile_phone'] );
                        $data['home_phone'] = preg_replace("/[^0-9]/", "", $data['mobile_phone'] );
                        $data['cpf'] = preg_replace("/[^0-9]/", "", $data['cpf'] );
                        
                        $tmp = explode("/",$data['date']);
                        #$date = $tmp[1] . "/" .  $tmp[0] . "/"  . $tmp[2];
                        $date =  $tmp[2] .  $tmp[1]  . $tmp[0];

                        DB::table('user_person')->insert([
                            'id_user' => $id_user,
                            'nm_user' => $data['name'],
                            'dt_birth' => $date,
                            'ph_mob' => $data['mobile_phone'],
                            'ph_res' => $data['home_phone'],
                            'cpf_user' => $data['cpf']

                        ]);
                        $res=1;
                        break;
                    
                    case 2:
                        $data['corp_phone'] = preg_replace("/[^0-9]/", "", $data['corp_phone'] );
                        $data['cnpj'] = preg_replace("/[^0-9]/", "", $data['cnpj'] );
                        DB::table('user_enterprise')->insert([
                            'id_user' => $id_user,
                            'nm_user' => $data['name'],
                            'ph_corp' => $data['corp_phone'],
                            'cnpj_user' => $data['cnpj']
                        ]);


                        $res=1;
                        break;

                    case 3:
                        $data['cnpj'] = preg_replace("/[^0-9]/", "", $data['cnpj'] );
                        $data['phone'] = preg_replace("/[^0-9]/", "", $data['phone'] );
                        $userCreated = User::create([
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
                        'id_cat' => $id_cat,
                        ]);

                        if($userCreated) {
                            DB::table('user_cooperative')->insert([
                                'id_user' => $userCreated->id_user,
                                'nm_user' => $data['name'],
                                'ph_numb' => $data['phone'],
                                'id_radius_user' => $data['radius'],
                                'cnpj_user' => $data['cnpj']
                            ]);
                        }

                        $res=1;
                        break;
                    
                    default:
                        $res = -1;
                        break;
        }
        }catch(\Exception $e){
            #dd($e);
            $res = -1;
        }

/* Changed logic - Now addresses are added once requesting - Victor 15-7-17

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
*/

        return $res;
    }

    public static function getStatus($id_user)
    {
        $res = DB::table('users')
                        ->select('id_del')
                        ->where('id_user',$id_user)
                        ->first()->id_del;

        return $res;

    }

    public static function userStatusToggle($id_user, $status)
    {
        DB::table('users')
                        ->where('id_user',$id_user)
                        ->update(['id_del' => $status]);
        $res = 1;
        return $res;

    }

    public static function getPassword($id_user,$old_password)
    {   
        $res = DB::table('users')->where([
            ['id_user', '=', $id_user],
            ['password', '=', $old_password],
        ])->get();

        return $res;
    }

    public static function updatePassword($id_user, $new_password)
    {

        try{
            DB::table('users')
            ->where('id_user', $id_user)
            ->update(['password' => $new_password]);

            $res = 1;
        } 
        catch(\Exception $e){
            $res = 0;
            dd($e);
        }
        
        return $res;
    }

    public static function get_email_user_by_id_req($id_req){

        $id_user_req = DB::table('request_master')->where('id_req_master', $id_req)->value('id_user_req');
        
        $email = DB::table('users')->where('id_user', $id_user_req)->value('email');

        return $email;
    }

}
