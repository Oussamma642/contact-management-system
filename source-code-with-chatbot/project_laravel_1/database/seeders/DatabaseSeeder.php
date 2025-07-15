<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use \App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Comment out these lines if you don't want to delete existing data
        Schema::disableForeignKeyConstraints();
        DB::table('related_persons')->truncate(); // Pivot table first
        DB::table('contacts')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        // First create users
        $this->call([
            UserSeeder::class,
        ]);

        // Then create contacts
        $this->call([
            ContactSeeder::class,
        ]);

        // Your existing contact relationship code is now moved to ContactSeeder
        // so we can remove it from here
    }
}