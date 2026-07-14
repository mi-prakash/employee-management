<?php

use App\Enums\EmployeeStatus;
use App\Models\Employee;
use App\Models\User;
use Carbon\CarbonInterface;

it('belongs to a user account', function () {
    $employee = Employee::factory()->create();

    expect($employee->user)
        ->toBeInstanceOf(User::class);
});

it('is accessible through the user employee relationship', function () {
    $employee = Employee::factory()->create();

    expect($employee->user->employee)
        ->toBeInstanceOf(Employee::class)
        ->id->toBe($employee->id);
});

it('casts employee attributes to their expected types', function () {
    $employee = Employee::factory()->create([
        'status' => EmployeeStatus::Inactive,
        'date_of_birth' => '1995-06-15',
        'joining_date' => '2024-01-10',
    ]);

    expect($employee->status)
        ->toBe(EmployeeStatus::Inactive)
        ->and($employee->date_of_birth)
        ->toBeInstanceOf(CarbonInterface::class)
        ->and($employee->joining_date)
        ->toBeInstanceOf(CarbonInterface::class);
});