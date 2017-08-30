<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\UserDao;
use Auth;

class Auth2000Controller extends Controller
{
	
    public function indexActivateAccount(Request $request){
        return view('activate_account');
    }

    public function loginActivateAccount(Request $request){
    	# login manually
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $this->activateAccount(Auth::user());
            return redirect('/home');
        }else{
            $request->session()->flash('message', 'Erro ao ativar conta. Email ou senha incorreta.');
            $request->session()->flash('alert-warning', 'warning');
            return view('activate_account');
        }
    	
    	
    }

	public function activateAccount($user){
    	$id_user = $user->id_user;

    	$res = UserDao::userStatusToggle($id_user, 0);    	
    }

}
