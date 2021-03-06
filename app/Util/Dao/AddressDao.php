<?php

namespace App\Util\Dao;

use DB;
use App\Util\Utilities;

class AddressDao

{
    public static function getDistance(
      $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
      // convert from degrees to radians
      $latFrom = deg2rad($latitudeFrom);
      $lonFrom = deg2rad($longitudeFrom);
      $latTo = deg2rad($latitudeTo);
      $lonTo = deg2rad($longitudeTo);

      $lonDelta = $lonTo - $lonFrom;
      $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
      $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

      $angle = atan2(sqrt($a), $b);
      return $angle * $earthRadius;
    }

    public static function getAddressesById($id_add)
    {
        
        $res = DB::table('address')
        ->where('id_add', $id_add)
        ->where('id_del', 0)
        ->get();


        return $res;
    }
    
    public static function getAddresses($id_user)
    {
        
        $res = DB::table('address')
        ->where('id_user', $id_user)
        ->where('id_del', 0)
        ->get();


        return $res;
    }

    public static function deleteAddress($id_user, $id_address)
    {
        $res = 1;

        try{
            
            DB::table('address')
            ->where('id_user', $id_user)
            ->where('id_add', $id_address)
            ->update(['id_del' => 1]);


        }catch(\Exception $e){
            dd($e);
            $res = 0;
        }

        
        


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

    public static function get_all_coop_address() // Pending requests for coop
    {

        $list = DB::table('user_cooperative')
        ->join('address', function ($join) {
            $join->on('user_cooperative.id_user', '=', 'address.id_user')
                 ->where('address.main_address', 1);
            })
            ->get();
                    
        return $list;
    }
}
