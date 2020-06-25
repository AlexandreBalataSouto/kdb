<?php

use App\Competicion;
use Illuminate\Database\Seeder;

class CompeticionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Competicion::class, 200)->create();
        foreach(Competicion::all() as $competicion){
            $karatecas = \App\Karateca::inRandomOrder()->take(rand(1,10))->pluck('id_karateca');
            $competicion->karatecas()->sync($karatecas);
        }
    }
}
