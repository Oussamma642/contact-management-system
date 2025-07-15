<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function handleVoice(Request $request)
    {
        $message = strtolower($request->input('message'));

        // Example: "add contact named ali with phone number 0612345678"
        preg_match('/named\s+(\w+)\s+.*phone number\s+(\d{10})/', $message, $matches);

        if (count($matches) === 3) {
            $name = ucfirst($matches[1]);
            $phone = $matches[2];

            Contact::create([
                'name' => $name,
                'phone' => $phone,
            ]);

            return response()->json([
                'response' => "✅ Contact '$name' saved with number $phone.",
            ]);
        }

        return response()->json([
            'response' => "❌ Sorry, I couldn't understand the contact info.",
        ], 400);
    }

    public function addContact(Request $request)
    {
        $request->validate([
            'contactInfo' => 'required|string',
        ]);

        // Parse the contact information from the voice input
        $contactData = explode(',', $request->contactInfo);
        
        if (count($contactData) < 4) {
            return response()->json(['success' => false, 'message' => 'Please provide name, email, phone, and category.']);
        }

        $contact = new Contact();
        $contact->name = trim($contactData[0]);
        $contact->email = trim($contactData[1]);
        $contact->phone = trim($contactData[2]);
        $contact->category = trim($contactData[3]);
        $contact->user_id = Auth::id(); // Associate with the logged-in user
        $contact->save();

        return response()->json(['success' => true]);
    }
}
