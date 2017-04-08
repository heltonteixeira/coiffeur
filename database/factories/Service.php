<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Service::class, function (Faker\Generator $faker) {
    $fakerBR = Faker\Factory::create('pt_BR');

    return [
        'name' => str_replace([',', '.'], '', $faker->sentence(4)),
        // 'name' => $faker->sentence,
        'base_cost' => $faker->numberBetween(25, 500),
        'description' => $faker->boolean ? $faker->realText(100) : null,
    ];
});
