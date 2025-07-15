<?php

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class ParticipationsSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         //
//     }
// }

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('participations')->insert([
            ['films_id' => 1, 'acteur_id' => 1, 'role' => 'Dom Cobb', 'typeRole' => 'principal'],
            ['films_id' => 2, 'acteur_id' => 2, 'role' => 'Kim Ki-taek', 'typeRole' => 'principal'],
        ]);
    }
}