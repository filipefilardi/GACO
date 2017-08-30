<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\AddressDao;
use App\Util\Dao\UserDao;
use Auth;
use Hash;
use Session;

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

        $request['id_cep'] = preg_replace("/[^0-9]/", "", $request['id_cep'] );
        
        $res = AddressDao::insertAndUpdateAddress(Auth::user()->id_user,$request->all());
        if($res){
            $request->session()->flash('message', 'Endereço adicionado com sucesso!'); 
            $request->session()->flash('alert-success', 'success'); 

        }else{
            $request->session()->flash('message', 'Falha no cadastro. Por favor, preencha seus dados novamente.'); 
            $request->session()->flash('alert-dange', 'danger');
            
        }
        $addresses = AddressDao::getAddresses(Auth::user()->id_user);
        return redirect('/settings')->with('addresses',$addresses);
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

    public function deleteAccount(Request $request){
        
        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password])){
            $id_user = Auth::user()->id_user;

            $res = UserDao::userStatusToggle($id_user, 1);

            Auth::logout();
            Session::flush();
            return redirect('/');
        }else{
            $request->session()->flash('message', 'Erro ao desativar conta. Senha incorreta.');
            $request->session()->flash('alert-warning', 'warning');
        }

        $addresses = AddressDao::getAddresses(Auth::user()->id_user);
        return redirect('/settings')->with('addresses',$addresses);
    	
    	
    }

    
}
