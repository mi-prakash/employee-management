<?php

namespace App\Models;

use App\Enums\EmployeeStatus;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represents an employee profile.
 *
 * Authentication information is stored in the users table,
 * while employee-specific information is stored here.
 */
#[Fillable([
    'user_id',
    'employee_id',
    'phone',
    'address',
    'date_of_birth',
    'joining_date',
    'designation',
    'department',
    'status',
])]
class Employee extends Model
{
    /** @use HasFactory<EmployeeFactory> */
    use HasFactory;

    /**
     * Get the user account associated with the employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cast model attributes.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'joining_date' => 'date',
            'status' => EmployeeStatus::class,
        ];
    }
}