<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    $dates = [$faker->dateTime, $faker->dateTime];
    sort($dates);
    return [
        'name'             => $faker->catchPhrase,
        'recorded_date'    => array_shift($dates),
        'release_date'     => array_shift($dates),
        'number_of_tracks' => $faker->numberBetween(0, 20),
        'label'            => $faker->company.' '.$faker->companySuffix,
        'producer'         => $faker->name,
        'genre'            => $faker->word,
    ];
});
