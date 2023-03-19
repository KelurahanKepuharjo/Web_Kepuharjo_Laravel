<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\master_kk;

class MasterKKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FacadesDB::table('master_kks')->insert([
            'name' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
