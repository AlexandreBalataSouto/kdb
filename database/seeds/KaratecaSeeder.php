<?php

use App\Karateca;
use Illuminate\Database\Seeder;

class KaratecaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Karateca::class, 200)->create();
    }
}
