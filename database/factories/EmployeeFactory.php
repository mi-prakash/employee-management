<?php

namespace Database\Factories;

use App\Enums\EmployeeStatus;
use App\Enums\UserRole;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The model associated with the factory.
     *
     * @var class-string<Employee>
     */
    protected $model = Employee::class;

    /**
     * Define the employee's default fake data.
     *
     * A user account with the employee role is automatically created
     * unless an existing user is explicitly provided to the factory.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state([
                'role' => UserRole::Employee,
            ]),
            'employee_id' => fake()->unique()->numerify('EMP-######'),
            'phone' => fake()->numerify('###-###-####'),
            'address' => fake()->address(),
            'date_of_birth' => fake()->dateTimeBetween('-65 years', '-18 years'),
            'joining_date' => fake()->dateTimeBetween('-10 years', 'now'),
            'designation' => fake()->randomElement([
                'Software Engineer',
                'Data Analyst',
                'Project Coordinator',
                'Human Resources Specialist',
                'Accountant',
            ]),
            'department' => fake()->randomElement([
                'Engineering',
                'Data',
                'Operations',
                'Human Resources',
                'Finance',
            ]),
            'status' => fake()->randomElement(EmployeeStatus::cases()),
        ];
    }
}