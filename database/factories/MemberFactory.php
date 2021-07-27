<?php

use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(App\Models\Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'age' => $faker->numberBetween(10, 70),
        'address' => $faker->address,
        'telephone' => $faker->numerify('628##########'),
        'identity_number' => $faker->numerify('320############'),
        'date_of_joined' =>$faker->date('Y-m-d', 'now'),
        'is_active' => Arr::random([true, false]),
    ];
});
