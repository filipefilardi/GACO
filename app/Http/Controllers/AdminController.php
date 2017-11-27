<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\UserDao;
use App\Util\Dao\AddressDao;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_admin(Request $request) {
 		Auth::user();
        if(Auth::user()->id_cat != 4){ // apenas para admin
            return redirect('/home');
        }
        else {
            $coops = UserDao::getListUsersByCat(3);
            return view('admin')->with('coops',$coops);
        }
    }

    public function insertCoop(Request $request)
    {   
        $res = UserDao::insert(Auth::user()->id_user,$request->all(),3); // 3 - ID CAT de Coop

        $request['id_cep'] = preg_replace("/[^0-9]/", "", $request['id_cep'] );



        if($res == 1){
            $new_user_id = UserDao::getIdByEmail($request->email);
            $address = AddressDao::insertAndUpdateAddress($new_user_id->toArray()[0]->id_user,$request->all());

            if($address == 1){
                $request->session()->flash('message', 'Cooperativa criada com sucesso!'); 
                $request->session()->flash('alert-success', 'sucess');
            }else{
                $request->session()->flash('message', 'Falha ao criar cooperativa. Por favor, tente novamente'); 
                $request->session()->flash('alert-warning', 'warning');
            }

            
        }else{
        }


        $coops = UserDao::getListUsersByCat(3);
        return redirect('admin')->with('coops',$coops);
    }
}
