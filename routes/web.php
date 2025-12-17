<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ShortUrlController;
use App\Jobs\SendInvitationEmailJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return redirect()->route('login')->with('error', 'Registration not allowed, Please login or contact to admin');
})->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Company CRUD
    Route::resource('companies', CompanyController::class);

    // Invitation CRUD
    Route::resource('invitations', InvitationController::class);

    // SHORT-URL
    Route::get('list-shortUrl', [ShortUrlController::class, 'index'])->name('shortUrls.index');
    Route::get('create-shortUrl', [ShortUrlController::class, 'craete'])->name('shortUrls.create');
    Route::post('store-shortUrl', [ShortUrlController::class, 'store'])->name('shortUrls.store');
    Route::get('redirect-shortUrl', [ShortUrlController::class, 'redirect'])->name('shortUrls.redirect');
});
