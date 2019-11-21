<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserTest extends TestCase
{

    // use RefreshDatabase;

    /**
     * Регистрация
     *
     * @return void
     */
    public function test_auth_register()
    {

        $register_user = factory(User::class)->make();

        $data = [
            "email"     => $register_user->email,
            "password"  => "123456"
        ];

        $response = $this->json("POST", route("api_register"), $data);  //->assertStatus(200);
        $response->assertJsonStructure([
            "token"
        ]);
    }


    /**
     * Вход в систему (по емейлу и паролю, аутентифицировать через
     * Bearer-token, с помощью j wt-auth ) .
     *
     * @return void
     */
    public function test_auth_login()
    {
        $data = [
            "email"     => "admin@admin.com",
            "password"  => 476674
        ];

        $response = $this->json("POST", route("api_login"), $data)->assertStatus(200);
        $result = $response->decodeResponseJson();
        // dd($result);
    }

}
