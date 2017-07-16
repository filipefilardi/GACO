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

    public function registerAddress(Request $request) {

        $res = AddressDao::insertAndUpdateAddress(Auth::user()->id_user,$request->all());
        if($res){
            $request->session()->flash('alert-success', 'success');
        }else{
            $request->session()->flash('alert-warning', 'warning');
            
        }
        $addresses = AddressDao::getAddresses(Auth::user()->id_user);
        return view('/settings')->with('addresses',$addresses);
    }
}
