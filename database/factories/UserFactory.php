<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$roles= \App\Role::all()->pluck('id')->toArray();
$factory->define(User::class, function (Faker $faker) use($roles) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sur_name' => $faker->lastName,
        'username'=>$faker->userName,
        'role_id'=>$faker->randomElement($roles),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
    ];
});



