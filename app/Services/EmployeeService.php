<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EmployeeService
{
    /**
     * Create a user account and its associated employee profile.
     *
     * A database transaction ensures that both records are created
     * successfully or neither record is persisted.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Employee
    {
        return DB::transaction(function () use ($data): Employee {
            $user = User::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => UserRole::Employee,
                'password' => $data['password'],
            ]);

            $employee = $user->employee()->create([
                'employee_id' => $this->generateEmployeeId(),
                'phone' => $data['phone'],
                'address' => $data['address'] ?? null,
                'date_of_birth' => $data['date_of_birth'],
                'joining_date' => $data['joining_date'],
                'designation' => $data['designation'],
                'department' => $data['department'],
                'status' => $data['status'],
            ]);

            Log::info('Employee created.', [
                'employee_id' => $employee->id,
                'user_id' => $user->id,
            ]);

            return $employee->load('user');
        });
    }

    /**
     * Update the user account and employee profile.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Employee $employee, array $data): Employee
    {
        return DB::transaction(function () use ($employee, $data): Employee {
            $employee->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            $employee->update([
                'phone' => $data['phone'],
                'address' => $data['address'] ?? null,
                'date_of_birth' => $data['date_of_birth'],
                'joining_date' => $data['joining_date'],
                'designation' => $data['designation'],
                'department' => $data['department'],
                'status' => $data['status'],
            ]);

            Log::info('Employee updated.', [
                'employee_id' => $employee->id,
                'user_id' => $employee->user_id,
            ]);

            return $employee->fresh('user');
        });
    }

    /**
     * Delete the employee profile and associated user account.
     */
    public function delete(Employee $employee): void
    {
        DB::transaction(function () use ($employee): void {
            $user = $employee->user;

            $employee->delete();
            $user->delete();

            Log::info('Employee deleted.', [
                'employee_id' => $employee->id,
                'user_id' => $user->id,
            ]);
        });
    }

    /**
     * Generate the next unique employee reference number.
     */
    private function generateEmployeeId(): string
    {
        do {
            $employeeId = 'EMP-'.Str::upper(Str::random(8));
        } while (
            Employee::query()
                ->where('employee_id', $employeeId)
                ->exists()
        );

        return $employeeId;
    }
}