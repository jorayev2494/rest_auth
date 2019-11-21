<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Проверка создателя книги
     *
     * @param User $user
     * @param Book $book
     * @return boolean
     */
    public function update(User $user, Book $book) : bool
    {
        return $user->id === $book->user->id;
    }

    public function destroy(User $user, Book $book) : bool
    {
        return $user->id === $book->user->id;
    }

}
