<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\AddressDao;
use Auth;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexSettings(Request $data) {
    	$addresses = AddressDao::getAddresses(Auth::user()->id_user);
        return view('/settings')->with('addresses',$addresses);
    }

    public function registerAddress(Request $data) {
    	//$addresses = AddressDao::getAddresses(Auth::user()->id_user);
        //return view('/settings')->with('addresses',$addresses);
    }
}
