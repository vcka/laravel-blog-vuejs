<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller {

    public $successStatus = 200;

    const ERROR_EMAIL_ALREADY = 'The email has already been taken.';

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $response = $this->getLoginAccessToken($user);
            return response()->json($response);
        } else {
            $response = array(
                'status' => 'error',
                'response_code' => 201,
                'errors' => array('user_invalid' => 'Invalid Credentials.')
            );
            return response()->json($response);
        }
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

    public function register(Request $request) {
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
            $response = $this->getLoginAccessToken($user);
        }
        return response()->json($response);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function fbLogin(Request $request) {
        $password = $this->generateRandomString();
        $request->request->add(['password' => $password, 'password_confirmation' => $password]);
        $user = array();
        if ($this->validator($request->all())->fails()) {
            $errors = $this->validator($request->all())->errors()->getMessages();
            if (!empty($errors['email'][0]) && $errors['email'][0] === self::ERROR_EMAIL_ALREADY) {
                $user = User::whereEmail($request->email)->first();
            }
        } else {
            $user = $this->create($request->all());
        }
        $response = $this->getLoginAccessToken($user);
        return response()->json($response);
    }

    public function gmLogin(Request $request) {
        $password = $this->generateRandomString();
        $request->request->add(['password' => $password, 'password_confirmation' => $password]);
        $user = array();
        if ($this->validator($request->all())->fails()) {
            $errors = $this->validator($request->all())->errors()->getMessages();
            if (!empty($errors['email'][0]) && $errors['email'][0] === self::ERROR_EMAIL_ALREADY) {
                $user = User::whereEmail($request->email)->first();
            }
        } else {
            $user = $this->create($request->all());
        }
        $response = $this->getLoginAccessToken($user);
        return response()->json($response);
    }

    private function getLoginAccessToken($user) {
        if (empty($user)) {
            return array(
                'status' => 'errors',
                'response_code' => 201,
                'errors' => null
            );
        }
        $access_token = JWTAuth::fromUser($user);
        $refresh_token = '';
        $response = array(
            'status' => 'success',
            'response_code' => 200,
            'data' => [
                'access_token' => $access_token,
                'refresh_token' => $refresh_token,
                'user_name' => $user->name,
            ]
        );
        return $response;
    }

    function generateRandomString($length = 10) {
        //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
