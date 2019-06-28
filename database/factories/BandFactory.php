<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Band;
use App\Album;
use Faker\Generator as Faker;

$factory->define(Band::class, function (Faker $faker) {
    $foods = [
        'Taco', 'Burger', 'Burrito', 'Pizza', 'Noodle', 'Cheese', 'Pasta', 'Beef', 'Pork', 'Chicken', 'Egg', 'Muffin', 'Bread',
        'Peanutbutter', 'Chocolate', 'Pho', 'Pineapple', 'Banana', 'Berry', 'Yogurt', 'Stringbean', 'Lettuce', 'Kale', 'Apple',
    ];
    $glue = [
        '', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', '.', ',', ';', ':', '/', '-', '_',
    ];
    $animals = [
        'Cat', 'Dog', 'Horse', 'Pig', 'Chicken', 'Cow', 'Muskox', 'Buffalo', 'Bison', 'Bear', 'Eagle', 'Starling', 'Dolphin',
        'Whale', 'Orca', 'Seal', 'Panda', 'Moth', 'Butterfly', 'Serpent', 'Mole', 'Rat', 'Puppy', 'Silkworm', 'Sloth', 'Loris',
    ];
    return [
        'name'         => $faker->randomElement($foods).$faker->randomElement($glue).$faker->randomElement($animals),
        'start_date'   => $faker->dateTime,
        'website'      => $faker->url,
        'still_active' => $faker->randomDigitNotNull % 2,
    ];
});

$factory->afterCreating(Band::class, function ($band, $faker) {
    $i = 0;
    $albumCount = $faker->numberBetween(0, 5);
    while ($i++ < $albumCount) {
        $band->albums()->save(
            factory(Album::class)->make()
        );
    }
});
