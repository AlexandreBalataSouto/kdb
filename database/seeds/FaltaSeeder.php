<?php

use App\Falta;
use Illuminate\Database\Seeder;

class FaltaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Falta::class, 400)->create();
    }
}
