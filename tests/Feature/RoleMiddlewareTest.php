<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::middleware(['web', 'auth', 'role:super_admin,admin'])
        ->get('/test/admin-only', fn () => response()->noContent());
});

it('allows a super admin to access an administrative route', function () {
    $user = User::factory()->create([
        'role' => UserRole::SuperAdmin,
    ]);

    $this->actingAs($user)
        ->get('/test/admin-only')
        ->assertNoContent();
});

it('allows an admin to access an administrative route', function () {
    $user = User::factory()->create([
        'role' => UserRole::Admin,
    ]);

    $this->actingAs($user)
        ->get('/test/admin-only')
        ->assertNoContent();
});

it('forbids an employee from accessing an administrative route', function () {
    $user = User::factory()->create([
        'role' => UserRole::Employee,
    ]);

    $this->actingAs($user)
        ->get('/test/admin-only')
        ->assertForbidden();
});

it('redirects a guest from an administrative route', function () {
    $this->get('/test/admin-only')
        ->assertRedirect();
});