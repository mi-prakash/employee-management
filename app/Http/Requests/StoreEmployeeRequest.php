<?php

namespace App\Http\Requests;

use App\Enums\EmployeeStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine whether the user may submit this request.
     *
     * Administrative access is enforced by the route middleware.
     * Model-specific authorization will be handled by a policy later.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules for creating an employee.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],

            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],

            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'joining_date' => ['required', 'date', 'before_or_equal:today'],
            'designation' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(EmployeeStatus::class)],
        ];
    }
}