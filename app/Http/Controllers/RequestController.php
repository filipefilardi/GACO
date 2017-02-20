<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Request as MyRequest;
use Auth;
use DB;

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
    public function index_user()
    {
    	$customers = User::where('category', 1)->get();

        return view('request', ['customers' => $customers]);
    }

    public function index_customer()
    {
    	#$notifications = MyRequest::where('customer_id', Auth::user()->id_code)->get();

    	$notifications = DB::table('users')
  						->join('requests', function ($join) {
            				$join->on('users.id_code', '=', 'requests.user_id_code')
                 			->where('requests.customer_id_code', '=', Auth::user()->id_code);
        				})
        				->get();
        return view('request', ['notifications' => $notifications]);
    }

    public function makeRequest(Request $request)
    {
    	$user_id_code = Auth::user()->id_code;

    	echo Auth::user()->id_code;
    	echo " requests: ";
    	echo $request->input("id_code");

    	$customer_id_code = $request->input("id_code");

    	DB::table('requests')->insert([
            ['user_id_code' => $user_id_code,
            'customer_id_code' => $customer_id_code,
            ]

        ]);
    }
}
