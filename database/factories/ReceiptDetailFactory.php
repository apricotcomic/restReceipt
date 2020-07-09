<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\receipt_detail;
use Faker\Generator as Faker;

$factory->define(receipt_detail::class, function (Faker $faker) {
    static $line_no = 1;
    static $unit_price;
    static $quantity;
    static $fee;
    $unit_price = $faker->randomNumber(4);
    $quantity = $faker->randomNumber(2);
    $fee = $unit_price * $quantity;
    return [
        //
        'line_no' => $line_no++,
        'item_name' => $faker->randomElement(['item_a','item_b','item_c','item_d','item_e',
        'item_f','item_g','item_h','item_i','item_j',]) . "\n",
        'unit_price' => $unit_price,
        'quantity' => $quantity,
        'fee' => $fee,
        'tax' => $fee / 10,
        'item_1' => $faker->word,
        'item_2' => $faker->word,
        'item_3' => $faker->word,
        'item_4' => $faker->word,
        'item_5' => $faker->word,
        'created_at' => $faker->datetimeThisMonth($max = 'now',$timezone = date_default_timezone_get()),
        'updated_at' => $faker->datetimeThisMonth($max = 'now',$timezone = date_default_timezone_get()),

    ];
});
