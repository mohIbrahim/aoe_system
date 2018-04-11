<?php

use Faker\Generator as Faker;

$factory->define(App\PrintingMachine::class, function (Faker $faker) {
    return [
        'folder_number'=>$faker->ean8,
        'model_prefix'=>$faker->word,
        'model_suffix'=>$faker->word,
    ];
});
