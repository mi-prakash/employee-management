<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Teams\TeamInvitationController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)
        ->name('dashboard');
    /*
    * Employee management is restricted to users with
    * super administrator or administrator roles.
    */
    Route::resource('employees', EmployeeController::class)
        ->middleware('role:super_admin,admin');
});

Route::middleware(['auth'])->group(function () {
    Route::get(
        'invitations/{invitation}/accept',
        [TeamInvitationController::class, 'accept'],
    )->name('invitations.accept');

    Route::delete(
        'invitations/{invitation}',
        [TeamInvitationController::class, 'decline'],
    )->name('invitations.decline');
});

require __DIR__.'/settings.php';