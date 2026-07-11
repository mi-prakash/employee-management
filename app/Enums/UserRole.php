<?php

namespace App\Enums;

/**
 * Defines the available roles within the application.
 *
 * These roles are used for authorization and route protection.
 * Every authenticated user must have exactly one role.
 */
enum UserRole: string
{
    /**
     * Has unrestricted access to the entire application.
     */
    case SuperAdmin = 'super_admin';

    /**
     * Can manage employees and day-to-day operations.
     */
    case Admin = 'admin';

    /**
     * Standard authenticated employee.
     */
    case Employee = 'employee';

    /**
     * Returns a human-readable label for UI display.
     */
    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::Admin => 'Administrator',
            self::Employee => 'Employee',
        };
    }

    /**
     * Determines whether the role has administrative privileges.
     *
     * This is useful for menus, middleware,
     * and authorization decisions.
     */
    public function isAdministrator(): bool
    {
        return match ($this) {
            self::SuperAdmin,
            self::Admin => true,

            self::Employee => false,
        };
    }
}