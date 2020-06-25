<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateAdminTest extends DuskTestCase
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
            function createAdmin($faker){
           
                $nombre = $faker->firstName();
                $apellidos = $faker->lastName();
                $fecha_nacimiento = $faker->date($format = 'd-m-Y', $max = '01-01-2008');
                $grados = array("1ºDan","2ºDan","3ºDan");
                $index = array_rand($grados);
                $grado = $grados[$index];
                $telefono = $faker->mobileNumber();
                if(strpos($telefono,"+34") !== false){
                    $telefono = substr($telefono,3);
                }
                $telefono = preg_replace('/[^0-9]/', '', $telefono);
                $email = $faker->email();
                $direccion = $faker->address();
    
                $datos = array("nombre"=>$nombre, "apellidos"=>$apellidos, "fecha_nacimiento"=>$fecha_nacimiento, "grado"=>$grado,
                "telefono"=>$telefono, "email"=>$email, "direccion"=>$direccion);
    
                return $datos;
            }
    
            $faker = $this->faker;
            $usuario = createAdmin($faker);
    
            echo implode(" / ",$usuario);

            $browser->visit('http://kdb.test/')
                    ->assertSee('KDB')
                    ->click('.welcomeButtons .btn.waves-effect.waves-light:nth-child(2)')
                    ->waitForText('Registrar')
                    ->type('#name',$usuario['nombre']." ".$usuario['apellidos'])
                    ->type('#email',$usuario['email'])
                    ->type('#password','csas1234')
                    ->type('#password-confirm','csas1234')
                    ->click("button[type='submit']")
                    ->waitForText('Nuevo monitor')
                    ->type('#nombre',$usuario['nombre'])
                    ->type('#apellidos',$usuario['apellidos'])
                    ->type('#fecha_nacimiento',$usuario['fecha_nacimiento'])
                    ->type('#direccion',$usuario['direccion'])
                    ->type('#telefono',$usuario['telefono'])
                    ->type('#email',$usuario['email'])
                    ->type('#grado',$usuario['grado'])
                    ->click("button[type='submit']")
                    ->waitForText('Listado de monitores')
                    ->pause(5000)
                    ->assertSee($usuario['nombre']." ".$usuario['apellidos']);
        });
    }
}
