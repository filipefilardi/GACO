<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\GarbageDao;

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
        $data['garbage'];

        return view('request');
    }

}
