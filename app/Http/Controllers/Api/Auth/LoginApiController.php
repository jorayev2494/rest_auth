<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->only("email", "password");

        try {
            $token = auth()->attempt($data);

            $login = [
                "my"        => auth()->userOrFail(),
                "token"     => $token,
            ];
            
        } catch (\Tymon\JwtAuth\Exceptions\UserNotDefinedException $exc) {
            return response()->json(["error" => $exc->getMessage()], 401);
        }

        return response()->json(["login" => $login], 200);

    }
}
