<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

class UserController extends Controller {

    public function profile(Request $request) {        
        $user = JWTAuth::toUser($request->token);
        $response = array(
            'status' => 'error',
            'response_code' => 201,
            'message' => 'Not a valid user'
        );
        if ($user) {
            $response = array(
                'status' => 'success',
                'response_code' => 200,
                'message' => 'Get user profile',
                'data' => array(
                    'name' => $user->name
                )
            );
        }
        return response()->json($response);
    }

}
