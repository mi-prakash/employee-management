<?php

namespace Database\Seeders;

use App\Enums\EmployeeStatus;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Seed employee profiles for development and testing.
     */
    public function run(): void
    {
        $employeeUser = User::query()
            ->where('email', 'employee@example.com')
            ->firstOrFail();

        /*
         * Create an employee profile for the predefined employee account.
         */
        Employee::factory()
            ->for($employeeUser)
            ->create([
                'employee_id' => 'EMP-000001',
                'designation' => 'Software Engineer',
                'department' => 'Engineering',
                'status' => EmployeeStatus::Active,
            ]);

        /*
         * Generate additional employee accounts and profiles so that
         * pagination, searching, and filtering can be tested later.
         */
        Employee::factory()
            ->count(24)
            ->create();
    }
}