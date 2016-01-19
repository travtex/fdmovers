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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Mover::class, function (Faker\Generator $faker) {
	return [
		'first_name' => $faker->firstNameMale,
		'last_name' => $faker->lastName,
		'email' => $faker->email,
		'hired_at' => $faker->dateTimeBetween('-1 year', '-1 week'),
	];
});

$factory->define(App\Truck::class, function (Faker\Generator $faker) {
	return [
		'make_model' => $faker->company,
		'model_year' => $faker->year,
		'vin' => $faker->md5,
		'serviced_at' => $faker->dateTimeBetween('-6 month', '-1 week')
	];
});

$factory->define(App\Crew::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->sentence(2, true)
	];
});

$factory->define(App\Move::class, function (Faker\Generator $faker) {
	return [
		'truck_id' => App\Truck::all()->random(1)->id,
		'crew_id' => App\Crew::all()->random(1)->id,
		'location' => $faker->streetAddress,
		'completed_at' => $faker->dateTimeBetween('-1 year', '+1 month')
	];
});