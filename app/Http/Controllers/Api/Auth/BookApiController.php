<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookApiController extends Controller
{

    private $book_r;

    public function __construct(BookRepository $bookRepository)
    {
        $this->book_r = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $this->authUser();
        return response()->json(["my_books" => $user->books], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = $this->authUser();

        $data = $request->all();


        $validator = Validator::make($data, [
            "title"             =>  "required|string",
            "count_page"        =>  "required|numeric|min:1|max:150",
            "annotation"        =>  "required|string",
            "picture"           =>  "required|string",
            "author_name"       =>  "required|string|min:2",
            "author_lastname"   =>  "required|string|min:2",
        ]);

        if ($validator->fails()) {
            return response()->json(["data_errors" => $validator->errors()->all()], 200);
        }


        // Добавит Автора
        $author = Author::create([
            "name"      => $data["author_name"],
            "lastname"  => $data["author_lastname"],
        ]);

        // Создавать Книгу для Авторизованного пользователя
        $book = $user->books()->create([
            "title"         => $data["title"],
            "count_page"    => $data["count_page"],
            "annotation"    => $data["annotation"],
            "picture"       => $data["picture"],
            // "picture"       => "https://lorempixel.com/50/50/people/?46307",
            "author_id"     => $author->id,
        ]);

        return response()->json(["added_books" => $book], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->authUser();

        $data = $request->all();

        $validator = Validator::make($data, [
            "title"             =>  "required|string",
            "count_page"        =>  "required|numeric|min:1|max:150",
            "annotation"        =>  "required|string",
            "picture"           =>  "required|string",
            // "author_name"       =>  "required|string|min:2",
            // "author_lastname"   =>  "required|string|min:2",
        ]);

        if ($validator->fails()) {
            return response()->json(["data_errors" => $validator->errors()->all()], 200);
        }

        // Найти книгу
        $updateBook = $this->book_r->getFindOrFail($id);

        // Проверка прав на редактирование
        if ($user->can("update", $updateBook)) {
            // Обновит Автора
            // $updateBook->author->update([
            //     "name"      => $data["author_name"],
            //     "lastname"  => $data["author_lastname"],
            // ]);

            // Обновит Книгу
            $updateBook->update([
                "title"         => $data["title"],
                "count_page"    => $data["count_page"],
                "annotation"    => $data["annotation"],
                "picture"       => $data["picture"],
            ]);

            return response()->json(["updated_book" => $updateBook], 200);
        }
        else {
            return response()->json(["error_update" => "you cannot edit this book"], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = $this->authUser();

        // Найти книгу
        $deleteBook = $this->book_r->getFindOrFail($id);

        // Проверка прав Создателя Книг
        if ($user->can("destroy", $deleteBook)) {
            $deleteBook->delete();
            return response()->json(["book_deleted" => "successful book deleted"], 200);
        } 
        else {
            return response()->json(["error_delete" => "you cannot delete this book"], 200);
        }
        
    }
}
