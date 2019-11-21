<?php

namespace Tests\Unit;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestTest extends TestCase
{

    private $author_r;
    private $book_r;

    public function setUp(): void
    {
        parent::setUp();
        $this->author_r = new AuthorRepository();
        $this->book_r = new BookRepository();
    }
    

    /**
     * Получение списка авторов
     *
     * @return void
     */
    public function test_action_authors()
    {
        $response = $this->json("GET", route("api_authors_list"));
        $response->assertStatus(200);

        $response->assertJson(["authors_list" => $this->author_r->getAll()->toArray()]);
    }

    /**
     * Получение общего списка книг
     *
     * @return void
     */
    public function test_action_books()
    {
        $response = $this->json("GET", route("api_books_list"))->assertStatus(200);
        $response->assertJson(["books_list" => $this->book_r->getAll()->toArray()]);
    }

    /**
     * Получение общего списка книг конкретного автора
     *
     * @return void
     */
    public function test_action_author_books()
    {
        $author_id = rand(1, $this->author_r->getAll()->count());
        $response = $this->json("GET", route("api_author_books_list", ["id" => $author_id]))->assertStatus(200);

        $author = $this->author_r->findById($author_id);
        $author_books = $author->books->toArray();

        $response->assertJson(["author_books_list" => $author_books]);
    }
    
    
}
