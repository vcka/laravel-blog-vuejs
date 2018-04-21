<?php

namespace App\Http\Controllers\Auth;

use App\Model\user\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    public function register(\Illuminate\Http\Request $request) {        
        if ($this->validator($request->all())->fails()) {
            $errors = $this->validator($request->all())->errors()->getMessages();            
            $clientErrors = array();
            foreach ($errors as $key => $value) {
                $clientErrors[$key] = $value[0];
            }
            $response = array(
                'status' => 'error',
                'response_code' => 201,
                'errors' => $clientErrors
            );            
        } else {
            $this->validator($request->all())->validate();
            $user = $this->create($request->all());
            $response = array(
                'status' => 'success',
                'response_code' => 200
            );
        }
        echo json_encode($response);
    }

}
