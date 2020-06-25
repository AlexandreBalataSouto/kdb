<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(MonitorSeeder::class);
        $this->call(KaratecaSeeder::class);
        $this->call(FaltaSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(CompeticionSeeder::class);
    }
}
