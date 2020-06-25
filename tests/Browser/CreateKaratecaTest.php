<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;

class CreateKaratecaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    use withFaker;

    public function testExample()
    {
        $this->browse(function (Browser $browser) {

            function formatPhone($phone){
                if(strpos($phone,"+34") !== false){
                    $phone = substr($phone,3);
                }
                $phone = preg_replace('/[^0-9]/', '', $phone);
                return $phone;
            }

            function createKarateca($faker){
                $nombre = $faker->firstName();
                $apellidos = $faker->lastName();
                $fecha_nacimiento = $faker->date($format = 'd-m-Y', $max = '01-01-2008');
                $dni = $faker->dni();
                $direccion = $faker->address();
                $codigo_postal = $faker->postcode();
                $municipios = array('Tias', 'Tinajo', 'San Bartolome', 'Yaiza', 'Haria', 'Arrecife', 'Teguise');
                $index = array_rand($municipios);
                $municipio = $municipios[$index];
                $telefono_fijo = $faker->tollFreeNumber();
                $telefono_fijo = formatPhone($telefono_fijo);
                $email = $faker->email();
                $nombre_madre_movil = $faker->mobileNumber();
                $nombre_madre_movil = formatPhone($nombre_madre_movil);
                $nombre_padre_movil = $faker->mobileNumber();
                $nombre_padre_movil = formatPhone($nombre_padre_movil);
                $movil_alumno = $faker->mobileNumber();
                $movil_alumno = formatPhone($movil_alumno);
                $fecha_alta = $faker->date($format = 'Y-m-d', $max = 'now');
                $peso =$faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 100) ;
                $altura = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 2);
                $generos = array('Varon','Mujer');
                $index = array_rand($generos);
                $genero = $generos[$index];
                $edad = $faker->numberBetween($min = 3, $max = 50);
                $observaciones = $faker->sentence($nbWords = 6, $variableNbWords = true);
                $categoria_id = $faker->numberBetween($min = 1, $max = 8);
                
                $datos = array("nombre"=>$nombre, "apellidos"=>$apellidos, "fecha_nacimiento"=>$fecha_nacimiento, "dni"=>$dni,
                "direccion"=>$direccion, "codigo_postal"=>$codigo_postal, "municipio"=>$municipio, "telefono_fijo"=>$telefono_fijo, 
                "email"=>$email,"nombre_madre_movil"=>$nombre_madre_movil, "nombre_padre_movil"=>$nombre_padre_movil, 
                "movil_alumno"=>$movil_alumno, "fecha_alta"=>$fecha_alta, "peso"=>$peso, "altura"=>$altura, "genero"=>$genero, 
                "edad"=>$edad, "observaciones"=>$observaciones, "categoria_id"=>$categoria_id);
    
                return $datos;
            }
    
            $faker = $this->faker;
            $karateca = createKarateca($faker);
            $usuario=User::first();
    
            echo implode(" / ",$karateca);

            $browser->visit('http://kdb.test/')
                    ->assertSee('KDB')
                    ->click('.welcomeButtons .btn.waves-effect.waves-light:nth-child(1)')
                    ->type('#email',$usuario->email)
                    ->type('#password','csas1234')
                    ->click("button[type='submit']")
                    ->waitForText('Listado de karatecas')
                    ->pause(2000)
                    ->click('.input-field.col.s12 .waves-effect.waves-light.btn')
                    ->waitForText('Nuevo karateca')
                    ->pause(2000)
                    ->type('#nombre',$karateca['nombre'])
                    ->type('#apellidos',$karateca['apellidos'])
                    ->type('#fecha_nacimiento',$karateca['fecha_nacimiento'])
                    ->type('#fecha_alta',$karateca['fecha_alta'])
                    ->select("select[name='genero']",$karateca['genero'])
                    ->type('#edad',$karateca['edad'])
                    ->select("select[name='categoria_id']",$karateca['categoria_id'])
                    ->type('#dni',$karateca['dni'])
                    ->select("select[name='municipio']",$karateca['municipio'])
                    ->type('#direccion',$karateca['direccion'])
                    ->type('#codigo_postal',$karateca['codigo_postal'])
                    ->type('#telefono_fijo',$karateca['telefono_fijo'])
                    ->type('#email',$karateca['email'])
                    ->type('#movil_alumno',$karateca['movil_alumno'])
                    ->type('#nombre_madre_movil',$karateca['nombre_madre_movil'])
                    ->type('#nombre_padre_movil',$karateca['nombre_padre_movil'])
                    ->type('#peso',$karateca['peso'])
                    ->type('#altura',$karateca['altura'])
                    ->type("textarea[name='observaciones']",$karateca['observaciones'])
                    ->click("button[type='submit']")
                    ->waitForText('Listado de karatecas')
                    ->pause(5000)
                    ;
        });
    }
}
