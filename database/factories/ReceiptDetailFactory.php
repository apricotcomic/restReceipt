<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\receipt_detail;
use Faker\Generator as Faker;

$factory->define(receipt_detail::class, function (Faker $faker) {
    static $line_no = 1;
    return [
        //
        'line_no' => $line_no++,
        'item_name' => $faker->word,
        'unit_price' => $faker->randomNumber(),
        'quantity' => $faker->randomNumber(),
        'tax' => $faker->randomNumber(),
        'fee' => $faker->randomNumber(),
        'item_1' => $faker->word,
        'item_2' => $faker->word,
        'item_3' => $faker->word,
        'item_4' => $faker->word,
        'item_5' => $faker->word,
        'created_at' => $faker->datetime($max = 'now',$timezone = date_default_timezone_get()),
        'updated_at' => $faker->datetime($max = 'now',$timezone = date_default_timezone_get()),

    ];
});
