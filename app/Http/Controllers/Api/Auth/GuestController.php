<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    private $author_r;
    private $book_r;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->author_r = $authorRepository;
    }

    public function authorsList()
    {
        return response()->json(["authors_list" => $this->author_r->getAll()], 200);
    }

    public function booksList(BookRepository $bookRepository)
    {
        $this->book_r = $bookRepository;
        return response()->json(["books_list" => $this->book_r->getAll()], 200);
    }

    public function authorBooksList($id)
    {
        $author = $this->author_r->getFindOrFail($id);
        return response()->json(["author_books_list" => $author->books], 200);
    }

    
}
