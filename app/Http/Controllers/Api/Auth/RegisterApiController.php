<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterApiRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterApiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterApiRequest $request)
    {
        $data = $request->validated();

        User::create([
            'name'      => "JWTAuth",
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);

        $token = Auth::attempt($request->only(["email", "password"]));
        
        if (!$token) {
            return response()->json(['error' => "Incorrect email/password"], 401);
        }

        return response()->json(["token" => $token], 200);
    }
}
