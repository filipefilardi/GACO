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

}
