<?php

use App\Curso;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Curso::class, 200)->create();
        foreach(Curso::all() as $curso){
            $karatecas = \App\Karateca::inRandomOrder()->take(rand(1,10))->pluck('id_karateca');
            $curso->karatecas()->sync($karatecas);
        }
        
    }
}
