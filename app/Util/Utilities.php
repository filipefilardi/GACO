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

	public static function parseWeekdaysPeriodToDB($data) {
		
		$weekdays_possible = ['domingo','segunda','terça','quarta','quinta','sexta','sabado'];
		$period_possible = ['manha','tarde','noite'];
		$weekdays_string = '';
		$period_string = '';
		$weekdays_period = [];
		$count = 0;

		for ($i = 0; $i < sizeof($weekdays_possible); $i++) {
			if(array_key_exists($weekdays_possible[$i],$data)) {
				if($data[$weekdays_possible[$i]] == '1') {
					if($count == 0) $weekdays_string = $weekdays_string . 1;
					else $weekdays_string = $weekdays_string . '-' . 1;
				}
			}
			elseif($count == 0) $weekdays_string = $weekdays_string . 0;
			else $weekdays_string = $weekdays_string . '-' . 0;
			$count++;
		}

		array_push($weekdays_period, $weekdays_string);
		$count = 0;

		for ($i = 0; $i < sizeof($period_possible); $i++) {
			if(array_key_exists($period_possible[$i],$data)) {
				if($data[$period_possible[$i]] == '1') {
					if($count == 0) $period_string = $period_string . 1;
					else $period_string = $period_string . '-' . 1;
				}
			}
			elseif($count == 0) $period_string = $period_string . 0;
			else $period_string = $period_string . '-' . 0;
			$count++;
		}

		array_push($weekdays_period, $period_string);

		return $weekdays_period;
	}

	public static function parseWeekdaysForUI($weekdays_str) {
		
		$weekdays_possible = ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'];

		$weekdays = [];
		$weekdays_str_split = preg_split('~-~', $weekdays_str);;

		for ($i = 0; $i < 7; $i++) {
			if($weekdays_str_split[$i] = '1') array_push($weekdays, $weekdays_possible[$i]);
		}

		return $weekdays;
	}

	public static function parsePeriodForUI($period_str) {
		
		$period_possible = [trans('app.morning'),trans('app.noon'),trans('app.night')];

        $day_period = array_search('1',explode("-",$period_str));

		return $period_possible[$day_period];
	}
}
