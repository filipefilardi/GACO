<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\GarbageDao;
use Auth;

class GarbageController extends Controller
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
    public function index_garbage() {
        $garbage = GarbageDao::get_list_garbage_actv();
        return view('garbage', ['garbage' => $garbage]);
    }
}
