<?php

namespace App\Enums;

/**
 * Defines the employment status of an employee.
 */
enum EmployeeStatus: string
{
    /**
     * Employee is currently working.
     */
    case Active = 'active';

    /**
     * Employee is no longer active.
     */
    case Inactive = 'inactive';

    /**
     * Get the display label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }
}