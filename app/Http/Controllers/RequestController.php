<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\GarbageDao;
use App\Util\Dao\RequestDao;
use Auth;

class RequestController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_user() {
        $garbage = GarbageDao::get_list_garbage_actv();
        return view('request', ['garbage' => $garbage]);
    }

    public function make_request(Request $data){
        Auth::user();

        RequestDAO::insert_request($data['id_garbage'],Auth::user()->id_user, $data['desc_req'], $data['mod_req'], $data['status_garbage']);

        $garbage = GarbageDao::get_list_garbage_actv();
        //return view('request', ['garbage' => $garbage])->with('status', 'PIROCA!');
        $data->session()->flash('alert-success', 'sucess');
        return redirect('/request');
    }

}
