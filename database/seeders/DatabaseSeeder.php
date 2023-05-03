<?php

namespace Database\Seeders;

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
        $this->call([

            input_berita_seeder::class,
        ]);
        //  \App\Models\User::factory(100)->create();
        //  \App\Models\master_kk::factory(10)->create();
    }
}
