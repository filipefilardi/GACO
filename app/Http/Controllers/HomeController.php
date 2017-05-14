<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Dao\RequestDao;
use Auth;

class HomeController extends Controller
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
    public function index()
    {
        Auth::user();
        $request = RequestDAO::get_all_requests_by_user(Auth::user()->id_user);

        return view('home', ['request' => $request]);
    }
}
