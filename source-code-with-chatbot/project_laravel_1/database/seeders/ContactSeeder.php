<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all users
        $users = User::all();

        // Define categories
        $categories = ['ami', 'famille', 'professionnel', 'collegue'];

        // Create contacts for each user with balanced categories
        foreach ($users as $user) {
            // Create at least one contact in each category for each user
            foreach ($categories as $category) {
                Contact::factory()
                    ->forUser($user)
                    ->create(['category' => $category]);
            }
            
            // Create a few more random contacts
            Contact::factory()
                ->count(4)
                ->forUser($user)
                ->create();
        }
        
        // Create relationships between contacts
        foreach (Contact::all() as $contactA) {
            // Get 1-3 random contacts to relate to
            $contactB = Contact::where('id', '!=', $contactA->id)
                ->inRandomOrder()
                ->take(rand(1, 3))
                ->pluck('id');
                
            // Define relationship types
            $relationshipTypes = [
                'friend', 'sibling', 'cousin', 'spouse', 
                'parent_of', 'child_of', 'mentor_of', 'mentee_of'
            ];
            
            // Use collect() instead of $this->faker
            $contactA->relatedContacts()->attach($contactB, [
                'type' => collect($relationshipTypes)->random(),
            ]);
        }
    }
} 