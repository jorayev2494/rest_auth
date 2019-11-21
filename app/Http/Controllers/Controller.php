<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Получить Авторизованного пользователя по JWT
     *
     * @return void
     */
    public function authUser()
    {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JwtAuth\Exceptions\UserNotDefinedException $exc) {
            return response()->json(["error" => $exc->getMessage()], 401);
        }

        return $user;
    }

}
