<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class FilmsSeeder extends Seeder
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

class FilmsSeeder extends Seeder
{
    public function run()
    {
        DB::table('films')->insert([
            ['titre' => 'Inception', 'pays' => 'USA', 'annee' => DB::raw('DEFAULT'), 'duree' => '02:28:00', 'genre' => 'Science-fiction'],
            ['titre' => 'Parasite', 'pays' => 'Corée du Sud', 'annee' => DB::raw('DEFAULT'), 'duree' => '02:12:00', 'genre' => 'Thriller'],
        ]);
    }
}