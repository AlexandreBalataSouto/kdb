<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Los años de las categorias deben ser los adecuados
    public function run()
    {
        DB::table('categorias')->insert(array(
            'nombre_categoria'=>'Benjamin',
            'anno_categoria'=>'1'
            ));
        DB::table('categorias')->insert(array(
            'nombre_categoria'=>'Alevin',
            'anno_categoria'=>'2'
            ));
        DB::table('categorias')->insert(array(
            'nombre_categoria'=>'Infantil',
            'anno_categoria'=>'3'
            ));
        DB::table('categorias')->insert(array(
            'nombre_categoria'=>'Juvenil',
            'anno_categoria'=>'4'
            ));
        DB::table('categorias')->insert(array(
            'nombre_categoria'=>'Cadete',
            'anno_categoria'=>'5'
            ));
        DB::table('categorias')->insert(array(
            'nombre_categoria'=>'Junior',
            'anno_categoria'=>'6'
            ));
        DB::table('categorias')->insert(array(
            'nombre_categoria'=>'Sub-21',
            'anno_categoria'=>'7'
            ));
        DB::table('categorias')->insert(array(
            'nombre_categoria'=>'Senior',
            'anno_categoria'=>'8'
            ));
    }
}
