<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        "user_id"       => rand(1, User::all()->count()),
        "title"         => $faker->title,
        "count_page"    => $faker->numberBetween(50, 10),
        "annotation"    => $faker->text(150),
        "picture"       => $faker->imageUrl(50, 50, "people"),
        // "author_id"     => rand(1, Author::all()->count()),
    ];
});
