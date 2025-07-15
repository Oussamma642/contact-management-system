<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 random users
        User::factory()->count(10)->create();
        
        // Check if admin user already exists before creating
        if (!User::where('email', 'admin@example.com')->exists()) {
            // Create admin user only if it doesn't exist
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin123'),
            ]);
        }
    }
} 