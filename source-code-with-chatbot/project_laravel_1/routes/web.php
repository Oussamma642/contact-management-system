<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {

    // Get all the contacts
    Route::get('/dashboard', [ContactController::class, 'index'])->name('dashboard');
    // Get all the related contacts
    Route::get('/related-contacts/{id}', [ContactController::class, 'relatedContacts'])->name('persons.RelatedPersons');
    // Crud ob Contacts [Updating, Delete]
    Route::resource('contacts', ContactController::class);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');

    // Exporting contacts to excel format
    Route::get('/export-contacts', [ContactController::class, 'exportToExcel'])->name('export.contacts');

    Route::get('/users', [UserController::class, 'index']);

    // -----------------------------Routes for sharing contacts:
        // Route for the List of shared contacts
    Route::post('/share', [ShareController::class, 'share'])->name('share.contacts');
        // Route for updating shared-contacts status
    Route::post('/share/update-status', [ShareController::class, 'updateStatus'])->name('share.updateStatus');
        // Route to get number of pendign shared-contacts
    Route::get('/shared-contacts', [ShareController::class, 'getPendingSharedContacts']);

    // Route for rejecting a shared-contact
    Route::delete('/shared-contacts/{id}', [ShareController::class, 'reject']);

    // Route for accepting a shared-contact
    Route::post('/accept-shared-contact', [ShareController::class, 'accept']);
});


Route::post('/chatbot/voice', [ChatbotController::class, 'handleVoice'])->name('chatbot.voice');

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/add-contact', [ChatbotController::class, 'addContact']);