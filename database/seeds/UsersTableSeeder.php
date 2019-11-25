<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
 
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, "admin")->create()->each(function ($admin) {
            $admin->books()->saveMany(factory(Book::class, 5)->make());
        });

        factory(User::class, 10)->create();
    }
}
