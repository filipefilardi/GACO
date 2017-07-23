<?php

namespace App\Util;

class Utilities
{
    
	public static function generate_dictionary() {
		$abc = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
		return $abc;
	}

	public static function randomize_dictionary($numb_of_letters) {
		$abc = Utilities::generate_dictionary();
		$result = '';
		
		for ($i = 1; $i <= $numb_of_letters; $i++) {
 			$result = $result . $abc[random_int(0, sizeof($abc)-1)];
		}

		return $result;
	}

	public static function get_lat_lon($add) {

		$result = array(0,0);
		$url = 'https://maps.googleapis.com/maps/api/geocode/json';
		$data = array('address'=>Utilities::prepare_address($add),'key'=>'');

		try {
			$rest_result = Utilities::CallAPI('GET',$url,$data);
			$parsed = json_decode($rest_result, true);

			$lat_long = $parsed['results'][0]['geometry']['location'];
			$result = array($lat_long['lat'],$lat_long['lng']);
		} catch (\Exception $e) {
			// TODO
		}

		return $result;
	}

	// Method: POST, PUT, GET etc
	// Data: array("param" => "value") ==> index.php?param=value

	private static function CallAPI($method, $url, $data = false)
	{
	    $curl = curl_init();

	    switch ($method)
	    {
	        case "POST":
	            curl_setopt($curl, CURLOPT_POST, 1);

	            if ($data)
	                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	            break;
	        case "PUT":
	            curl_setopt($curl, CURLOPT_PUT, 1);
	            break;
	        default:
	            if ($data) {
	                $url = sprintf("%s?%s", $url, http_build_query($data));
	                curl_setopt_array($curl, array(
    					CURLOPT_RETURNTRANSFER => 1,
    					CURLOPT_URL => $url
					));
	            }
	    }
	    $result = curl_exec($curl);
	    if(!$result) $result = file_get_contents($url);

	    curl_close($curl);

	    return $result;
	}

	public static function prepare_address($str_address) {
		$address_for_url = str_replace(' ','+',$str_address);
		return $address_for_url;
	}

}
