<?php

use Faker\Generator as Faker;

$factory->define(App\Contract::class, function (Faker $faker) {
    return [
        'code'=>$faker->postCode,
        'type'=>'منتهي',
    ];
});
