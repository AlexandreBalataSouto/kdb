<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Monitor;
use Faker\Generator as Faker;

$factory->define(Monitor::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->firstName,
        'apellidos'=>$faker->lastName,
        'fecha_nacimiento'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'grado'=>$faker->randomElement(['1º Dan','2º Dan','3º Dan']),
        'telefono'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'direccion'=>$faker->address,
    ];
});
