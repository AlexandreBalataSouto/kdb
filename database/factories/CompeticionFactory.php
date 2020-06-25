<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Competicion;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Competicion::class, function (Faker $faker) {
    
    static $ultimoCompeticion = 0;

    if (!function_exists('randomDate')) {
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
    $start = new Carbon($start);
    $end = $start->addDays(1);
    
    return [
        'id_competicion'=>'b'.$ultimoCompeticion++,
        'numero'=>$ultimoCompeticion,
        'title'=>'Competicion '.'b'.$ultimoCompeticion,
        'start'=>$start,
        'end'=>$start,
        'hora'=>$faker->time($format = 'H:i', $max = 'now'),
        'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'precio'=>$faker->randomFloat($nbMaxDecimals = 3, $min = 10, $max = 100),
        'color'=>'#04B404',
        'text_color'=>'#FFFFFF',
    ];
});
