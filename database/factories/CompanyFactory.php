<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\company;
use Faker\Generator as Faker;

$factory->define(company::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->company,
        'address' => $faker->address,
        'zip' => $faker->postcode,
        'tel' => $faker->phonenumber,
        'fax' => $faker->phonenumber,
        'email' => $faker->email,
        'created_at' => $faker->datetime($max = 'now',$timezone = date_default_timezone_get()),
        'updated_at' => $faker->datetime($max = 'now',$timezone = date_default_timezone_get()),
    ];
});
