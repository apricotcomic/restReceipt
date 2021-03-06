<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\receipt;
use Faker\Generator as Faker;

$factory->define(receipt::class, function (Faker $faker) {
    return [
        //
        'purchase_date' => $faker->datetimeThisMonth($max = 'now',$timezone = date_default_timezone_get()),
        'branch_id' => $faker->word,
        'terminal_id' => $faker->randomNumber(),
        'original_receipt_id' => $faker->randomNumber(),
        'total_tax' => $faker->numberBetween($min = 1000,$max = 9999999),
        'total_fee' => $faker->numberBetween($min = 100,$max = 9999990),
        'original_JSON_id' => $faker->randomNumber(),
        'created_at' => $faker->datetimeThisMonth($max = 'now',$timezone = date_default_timezone_get()),
        'updated_at' => $faker->datetimeThisMonth($max = 'now',$timezone = date_default_timezone_get()),
    ];
});
