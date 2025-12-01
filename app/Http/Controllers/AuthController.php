<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\LoginRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        // return($request);
        $credentials = $request->validated();
        if (!$token = auth('api')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            return response()->json(['message'=>'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }


    public function me()
    {
        return response()->json(['data'=> auth('api')->user() , 'message'=>'get data successfully' ],200);
    }
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }


    private static function createNewToken(string $token)
    {
        $auth = JWTAuth::setToken($token);
        $user = $auth->toUser();
        return response()->json([
            'id'   => $user->id,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $auth->factory()->getTTL() * 60
        ]);
    }
}
