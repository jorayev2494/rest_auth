<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/authors', ["uses" => 'Api\Auth\GuestController@authorsList', "as" => "api_authors_list"]);
Route::get('/books',   ["uses" => 'Api\Auth\GuestController@booksList', "as" => "api_books_list"]);
Route::get('/authors_books/{id}',   ["uses" => 'Api\Auth\GuestController@authorBooksList', "as" => "api_author_books_list"]);


Route::group(['prefix' => 'auth'], function() {
    Route::post('/register', ["uses" => "Api\Auth\RegisterApiController", "as" => "api_register"]);
    Route::post('/login', ["uses" => "Api\Auth\LoginApiController@login", "as" => "api_login"]);
});

Route::group(['prefix' => 'profile'], function() {
    Route::apiResource('/books', "Api\Auth\BookApiController");
});



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
