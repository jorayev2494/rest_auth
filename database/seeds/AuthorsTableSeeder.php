<?php

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Author::class, 15)->create()->each(function ($author) {
            $author->books()->saveMany(factory(Book::class, 20)->make());
        });        
    }
}
