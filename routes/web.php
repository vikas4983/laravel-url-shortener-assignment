<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    abort(403, 'Registration is disabled.');
})->name('register');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Company CRUD
    Route::resource('companies', CompanyController::class);

    // Invitation CRUD
    Route::resource('invitations', InvitationController::class);

    // Accept invitation
    Route::post('/invitations/{id}/accept', [InvitationController::class, 'accept'])
        ->name('invitations.accept');

    // Reject invitation
    Route::post('/invitations/{id}/reject', [InvitationController::class, 'reject'])
        ->name('invitations.reject');
});
