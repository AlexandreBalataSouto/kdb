<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Falta;
use App\Karateca;
use Faker\Generator as Faker;

$factory->define(Falta::class, function (Faker $faker) {

    if(!function_exists('randomDate')){
        function randomDate($startDate, $endDate, $format = 'Y-m-d') //Funcion para obtener una fecha aleatoria dada dos fechas
    {
        // Convert the supplied date to timestamp
        $min = strtotime($startDate);
        $max = strtotime($endDate);

        // Generate a random number from the start and end dates
        $val = mt_rand($min, $max);

        // Convert back to the specified date format
        return date($format, $val);
    }
    }
    
    $start = randomDate("01-01-2020","31-05-2020");

    return [
        'title'=>'Falta',
        'start'=>$start,
        'color'=>'#FF0000',
        'text_color'=>'#FFFFFF',
        'karateca_id'=>Karateca::all()->random()->id_karateca,
    ];
});
