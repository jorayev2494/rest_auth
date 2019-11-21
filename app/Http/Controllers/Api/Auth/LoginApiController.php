<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->only("email", "password");

        $token = auth()->attempt($data);

        $login = [
            "my"        => $this->authUser(),
            "token"     => $token,
        ];          
        

        return response()->json(["login" => $login], 200);

    }
}
