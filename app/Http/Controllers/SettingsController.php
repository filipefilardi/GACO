<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\AddressDao;
use App\Util\Dao\UserDao;
use Auth;
use Hash;

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

    public function updatePassword(Request $request) {
    	$id_user = Auth::user()->id_user;
    	if(Hash::check($request->old_password, Auth::user()->password) && $password_confirmation == $request->password){
    		 $res = UserDao::updatePassword($id_user, bcrypt($request->password));
    	}else{
    		$res = 0;
    	}

        if($res == 1){
            $request->session()->flash('alert-success', 'success');
        }else{
            $request->session()->flash('alert-warning', 'warning');
            
        }

        $addresses = AddressDao::getAddresses($id_user);
        return view('/settings')->with('addresses',$addresses);
    }

    
}
