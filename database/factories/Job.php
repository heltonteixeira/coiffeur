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
$factory->define(App\Job::class, function (Faker\Generator $faker) {
    $fakerBR = Faker\Factory::create('pt_BR');

    $client = App\Client::all()->random();
    $service = App\Service::all()->random();

    return [
        'client_id' => $client->id,
        'service_id' => $service->id,
        'payment_method' => $faker->numberBetween(0, 4),
        'total_cost' => $service->base_cost + $faker->numberBetween(10, 150),
        'observation' => $faker->boolean ? $faker->realText(110) : null,
        'accomplished_at' => $date = $faker->dateTimeBetween($client->created_at, 'now'),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
