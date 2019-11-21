<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileApiController extends Controller
{
    // public function profile()
    // {
    //     try {
    //         $user = auth()->userOrFail();

    //         $profile = [
    //             "my" => $user,
    //             "my_books" => $user->books
    //         ];
                
    //     } catch (\Tymon\JwtAuth\Exceptions\UserNotDefinedException $exc) {
    //         return response()->json(["error" => $exc->getMessage()], 401);
    //     }

    //     return response()->json(["profile" => $profile], 200);
    // }
}
