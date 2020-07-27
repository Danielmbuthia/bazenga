<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
$hospital = \App\Hospital::all()->pluck('id')->toArray();
$counties = \App\County::all()->pluck('id')->toArray();
$factory->define(\App\Branch::class, function (Faker $faker) use ($hospital,$counties) {
    return [
        'name'=>$faker->name,
        'hospital_id'=>$faker->randomElement($hospital),
        'county_id' => $faker->randomElement($counties),
        'address' => $faker->address,
        'mobile' => $faker->phoneNumber,
    ];
});
$factory->define(\App\Insurance::class,function (Faker $faker) use($hospital){
     return [
         'name'=>$faker->name,
         'hospital_id'=>$faker->randomElement($hospital),
     ];
});

