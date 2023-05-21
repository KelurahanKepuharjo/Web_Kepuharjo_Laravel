<?php

namespace Database\Seeders;

use Database\Seeders\KkSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\MasyarakatSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            //input_berita_seeder::class,
            KkSeeder::class,
            MasyarakatSeeder::class,
        ]);
        //  \App\Models\User::factory(100)->create();
        //  \App\Models\master_kk::factory(10)->create();
    }
}