<?php

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class ActeursSeeder extends Seeder
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

class ActeursSeeder extends Seeder
{
    public function run()
    {
        DB::table('acteurs')->insert([
            ['nom' => 'DiCaprio', 'prenom' => 'Leonardo', 'pays' => 'USA', 'date_naissance' => '1974-11-11', 'tel' => '123456789'],
            ['nom' => 'Song', 'prenom' => 'Kang-ho', 'pays' => 'Corée du Sud', 'date_naissance' => '1967-01-17', 'tel' => null],
        ]);
    }
}