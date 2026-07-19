<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeStatus;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly EmployeeService $employeeService,
    ) {
    }

    /**
     * Display a paginated listing of employees.
     */
    public function index(): Response
    {
        $employees = Employee::query()
            ->with('user')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('employees/Index', [
            'employees' => $employees,
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
            ],
        ]);
    }

    /**
     * Display the employee creation form.
     */
    public function create(): Response
    {
        return Inertia::render('employees/Create', [
            'statuses' => $this->statusOptions(),
        ]);
    }

    /**
     * Store a newly created employee.
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $this->employeeService->create($request->validated());

        return to_route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee): Response
    {
        return Inertia::render('employees/Show', [
            'employee' => $employee->load('user'),
        ]);
    }

    /**
     * Display the employee editing form.
     */
    public function edit(Employee $employee): Response
    {
        return Inertia::render('employees/Edit', [
            'employee' => $employee->load('user'),
            'statuses' => $this->statusOptions(),
        ]);
    }

    /**
     * Update the specified employee.
     */
    public function update(
        UpdateEmployeeRequest $request,
        Employee $employee,
    ): RedirectResponse {
        $this->employeeService->update(
            $employee,
            $request->validated(),
        );

        return to_route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Delete the specified employee and user account.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $this->employeeService->delete($employee);

        return to_route('employees.index')
            ->with('error', 'Employee deleted successfully.');
    }

    /**
     * Return employee-status options for Vue forms.
     *
     * @return array<int, array{value: string, label: string}>
     */
    private function statusOptions(): array
    {
        return array_map(
            fn (EmployeeStatus $status): array => [
                'value' => $status->value,
                'label' => $status->label(),
            ],
            EmployeeStatus::cases(),
        );
    }
}