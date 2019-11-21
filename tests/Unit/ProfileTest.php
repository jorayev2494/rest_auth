<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{

    private $auth_user;
    private $bearer_token = "Bearer ";

    public function setUp() : void
    {
        parent::setUp();

        $data = [
            "email"     => "admin@admin.com",
            "password"  => 476674,
        ];

        $response = $this->json("POST", route("api_login"), $data)->assertStatus(200);
        $result = $response->decodeResponseJson();
        $this->bearer_token .= $result["login"]["token"];
    }
    

    /**
     * Получение списка книг (которые создал пользователь);
     *
     * @return void
     */
    public function test_action_get_books()
    {
        $response = $this->json("GET", route("profile.books.index"))->assertStatus(200);
        $response->assertJson($response->decodeResponseJson());
        $this->assertNotNull($response->getContent());
        $result = $response->decodeResponseJson();
    }

    
    /**
     * Создание книги
     *
     * @return void
     */
    public function test_action_store_book()
    {
        $data = [
            // "Authorization"     => $this->bearer_token,
            "title"             => "Unit Title",
            "count_page"        => 55,
            "annotation"        => "Unit Annotation Annotation Annotation",
            "picture"           => "https://lorempixel.com/50/50/people/?46307",
            
            "author_name"       => "UnitName",
            "author_lastname"   => "UnitLastName",
        ];

        $this->json("POST", route("profile.books.store"), $data)->assertStatus(200)->assertJsonStructure([
            "added_books"
        ]);
        // dd($response->getContent());
    }

    /**
     * Редактирование книги
     *
     * @return void
     */
    public function test_action_update_book()
    {
        $data = [
            // "Authorization"     => $this->bearer_token,
            
            "title"             => "Unit Update Title",
            "count_page"        => 55,
            "annotation"        => "Unit Update Annotation Annotation Annotation",
            "picture"           => "https://lorempixel.com/50/50/people/?46307",
        ];

        $this->json("PUT", route("profile.books.update", ["book" => 4]), $data)->assertStatus(200)->assertJsonStructure([
            "updated_book" => [
                "id",
                "user_id",
                "title",
                "count_page",
                "annotation",
                "picture",
                "author_id",
                "created_at",
                "updated_at",
            ]
        ]);
    }

    /**
     * Удаление книги
     *
     * @return void
     */
    public function test_action_destroy_book()
    {
        // $data = [
        //     "Authorization"     => $this->bearer_token,
        // ];

        $this->json("DELETE", route("profile.books.destroy", ["book" => 3]))->assertStatus(200)->assertJsonStructure([
            "book_deleted"
        ]);
    }
}
