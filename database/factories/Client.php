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
$factory->define(App\Client::class, function (Faker\Generator $faker) {
    $fakerBR = Faker\Factory::create('pt_BR');

    $gender = $faker->boolean ? 'female' : 'male';
    $username = $faker->username;

    return [
        'name' => $fakerBR->name($gender),
        'phone' => $fakerBR->landlineNumber(false),
        'cellphone' => $fakerBR->cellphoneNumber(false),
        'whatsapp' => $faker->boolean,
        'email' => $username . '@laravel.app',
        'facebook' => $faker->boolean ? $username : null,
        'instagram' => $faker->boolean ? $username : null,
        'nickname' => $fakerBR->firstName($gender),
        'birthday' => $faker->date('Y-m-d', '-15 years'),
        'gender' => $gender,
        'address' => $fakerBR->streetAddress,
        'neighborhood' => $fakerBR->region,
        'city' => $fakerBR->city,
        'state' => $fakerBR->stateAbbr,
        'created_at' => $date = $faker->dateTimeBetween('-1 year', 'now'),
        'updated_at' => $date,
    ];
});
