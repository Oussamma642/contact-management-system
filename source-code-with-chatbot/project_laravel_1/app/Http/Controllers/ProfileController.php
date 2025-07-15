<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        return view('profile');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validate the request
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);
        
        // Update the user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();
        
        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès!');
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        // Validate the request
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        // Update the password
        $user->password = Hash::make($validated['password']);
        $user->save();
        
        return redirect()->route('profile')->with('success', 'Mot de passe mis à jour avec succès!');
    }
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        // Get current user
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/login');
        }
        
        // Save ID for deleting
        $userId = $user->id;
        
        // Logout first
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Use very basic, direct SQL to delete
        try {
            // Execute the most basic DELETE possible
            DB::statement("SET FOREIGN_KEY_CHECKS=0");
            
            $deleted = DB::delete("DELETE FROM users WHERE id = ?", [$userId]);
            
            DB::statement("SET FOREIGN_KEY_CHECKS=1");
            
            return redirect('/login')->with('success', 'Votre compte a été supprimé.');
        } 
        catch (\Exception $e) {
            // Log error
            \Log::error("Failed to delete user {$userId}: " . $e->getMessage());
            
            // Redirect to login anyway since we've already logged them out
            return redirect('/login')->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
} 