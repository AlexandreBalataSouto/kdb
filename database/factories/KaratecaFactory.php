<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Karateca;
use Faker\Generator as Faker;

$factory->define(Karateca::class, function (Faker $faker) {
    
    if(!function_exists('formatPhone')){
        function formatPhone($phone){
            if(strpos($phone,"+34") !== false){
                $phone = substr($phone,3);
            }
            $phone = preg_replace('/[^0-9]/', '', $phone);
            return $phone;
        }
    }
    
    $phone= $faker->mobileNumber;
    $phone = formatPhone($phone);
    $tollNumber = $faker->tollFreeNumber;
    $tollNumber = formatPhone($tollNumber);


    return [
        'nombre'=>$faker->firstName,
        'apellidos'=>$faker->lastName,
        'fecha_nacimiento'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'dni'=>$faker->dni,
        'direccion'=>$faker->address,
        'codigo_postal'=>$faker->postcode,
        'municipio'=>$faker->randomElement(['Tias', 'Tinajo', 'San Bartolome', 'Yaiza', 'Haria', 'Arrecife', 'Teguise']),
        'telefono_fijo'=>$tollNumber,
        'email'=>$faker->email,
        'nombre_madre_movil'=>$phone,
        'nombre_padre_movil'=>$phone,
        'movil_alumno'=>$phone,
        'fecha_alta'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'peso'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 100),
        'altura'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 2),
        'genero'=>$faker->randomElement(['Varon','Mujer']),
        'edad'=>$faker->numberBetween($min = 3, $max = 50),
        'observaciones'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'monitor_id'=>1,
        'categoria_id'=>$faker->numberBetween($min = 1, $max = 8)
    ];
});
