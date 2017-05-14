<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'category' => 'required',
             //TODO: we need to verify this!!!
             // id_code: cpf/cnpj
             // we need to check whether its a real pessoa física/ pessoa jurídica
            //'id_code' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }    

    protected $id_cat_mapped = -1;

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        switch ($data['category']) {
        case 0:
            $id_cat_mapped = 1;
            break;
        case 1:
            $id_cat_mapped = 2;
            break;
        }

        if($id_cat_mapped > 0){

            dd($id_cat_mapped);

            return User::create([
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'id_cat' => (int)$id_cat_mapped,
            ]);
        }

    }
}

/*

*/