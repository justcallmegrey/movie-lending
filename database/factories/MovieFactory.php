<?php

use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(App\Models\Movie::class, function (Faker $faker) {
    $genres = \App\Models\Constants::GENRES;

    $arrayMovies = [
        'Inception',
        'Shawshank Redemption',
        'Interstellar',
        'Dunkirk',
        'The Special Network',
        'Assassin Creed',
        'Scorpion King',
        'Harry Potter',
        'The Lord of The Rings',
        'Marvel Avengers Endgame',
        'The Dark Knight',
        'James Bond',
        '3 Idiots',
        'Spider Man Homecoming',
        'The Godfather',
        'Taxi',
        'Fast and Furious',
        'The Mechanic',
        'Terminator',
        'Oblivion',
        'Sunny',
        'Gamgi AKA Flu',
        'Parasite',
        'Minions',
    ];

    return [
        // 'title' =>$faker->realText(50, 1),
        'title' => Arr::random($arrayMovies),
        'genre' => Arr::random($genres),
        'released_date' =>$faker->date('Y-m-d', 'now'),
        'is_rented' => false,
    ];
});
