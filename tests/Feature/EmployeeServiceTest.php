<?php

use App\Enums\EmployeeStatus;
use App\Enums\UserRole;
use App\Models\Employee;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Return valid employee data for service tests.
 *
 * @return array<string, mixed>
 */
function validEmployeeData(array $overrides = []): array
{
    return array_merge([
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'password' => 'Password123!',
        'phone' => '850-555-0100',
        'address' => '123 Main Street, Pensacola, FL',
        'date_of_birth' => '1990-05-15',
        'joining_date' => '2026-07-15',
        'designation' => 'Software Engineer',
        'department' => 'Engineering',
        'status' => EmployeeStatus::Active,
    ], $overrides);
}

it('creates a user account and employee profile', function () {
    $employee = app(EmployeeService::class)->create(
        validEmployeeData(),
    );

    expect($employee)
        ->toBeInstanceOf(Employee::class)
        ->and($employee->user)
        ->toBeInstanceOf(User::class)
        ->and($employee->user->role)
        ->toBe(UserRole::Employee)
        ->and($employee->status)
        ->toBe(EmployeeStatus::Active);

    $this->assertDatabaseHas('users', [
        'email' => 'john.doe@example.com',
        'role' => UserRole::Employee->value,
    ]);

    $this->assertDatabaseHas('employees', [
        'id' => $employee->id,
        'user_id' => $employee->user_id,
        'designation' => 'Software Engineer',
        'department' => 'Engineering',
    ]);
});

it('updates the user account and employee profile', function () {
    $employee = Employee::factory()->create();

    $updatedEmployee = app(EmployeeService::class)->update(
        $employee,
        validEmployeeData([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'designation' => 'Senior Software Engineer',
            'department' => 'Platform Engineering',
            'status' => EmployeeStatus::Inactive,
        ]),
    );

    expect($updatedEmployee->user->name)
        ->toBe('Jane Doe')
        ->and($updatedEmployee->user->email)
        ->toBe('jane.doe@example.com')
        ->and($updatedEmployee->designation)
        ->toBe('Senior Software Engineer')
        ->and($updatedEmployee->department)
        ->toBe('Platform Engineering')
        ->and($updatedEmployee->status)
        ->toBe(EmployeeStatus::Inactive);
});

it('deletes the employee profile and associated user account', function () {
    $employee = Employee::factory()->create();
    $employeeId = $employee->id;
    $userId = $employee->user_id;

    app(EmployeeService::class)->delete($employee);

    $this->assertDatabaseMissing('employees', [
        'id' => $employeeId,
    ]);

    $this->assertDatabaseMissing('users', [
        'id' => $userId,
    ]);
});