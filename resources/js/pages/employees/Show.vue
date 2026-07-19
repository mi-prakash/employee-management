<script setup lang="ts">
import { edit, index } from '@/routes/employees';
import type { Employee } from '@/types/employee';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    employee: Employee;
}>();
</script>

<template>
    <Head :title="employee.user.name" />

    <div class="p-6">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">
                    Employee Details
                </h1>

                <p class="text-sm text-muted-foreground">
                    View the employee's personal and employment information.
                </p>
            </div>

            <Link
                :href="edit(employee.id)"
                class="inline-flex w-fit items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90"
            >
                Edit Employee
            </Link>
        </div>

        <div class="space-y-6">
            <section class="rounded-lg border border-border bg-card">
                <div class="border-b border-border px-6 py-4">
                    <h2 class="text-lg font-semibold">
                        User Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Account and contact details.
                    </p>
                </div>

                <div class="grid gap-6 p-6 md:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Full Name
                        </p>

                        <p class="mt-1 text-sm text-foreground">
                            {{ employee.user.name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Email
                        </p>

                        <p class="mt-1 text-sm text-foreground">
                            {{ employee.user.email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Phone
                        </p>

                        <p class="mt-1 text-sm text-foreground">
                            {{ employee.phone }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Date of Birth
                        </p>

                        <p class="mt-1 text-sm text-foreground">
                            {{ employee.date_of_birth }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-muted-foreground">
                            Address
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm text-foreground">
                            {{ employee.address || 'Not provided' }}
                        </p>
                    </div>
                </div>
            </section>

            <section class="rounded-lg border border-border bg-card">
                <div class="border-b border-border px-6 py-4">
                    <h2 class="text-lg font-semibold">
                        Employment Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Employee role and organization details.
                    </p>
                </div>

                <div class="grid gap-6 p-6 md:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Employee ID
                        </p>

                        <p class="mt-1 text-sm text-foreground">
                            {{ employee.employee_id }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Status
                        </p>

                        <div class="mt-2">
                            <span
                                class="rounded-full border px-2 py-1 text-xs font-medium capitalize"
                                :class="
                                    employee.status === 'active'
                                        ? 'border-green-200 bg-green-100 text-green-700 dark:border-green-900 dark:bg-green-950 dark:text-green-400'
                                        : 'border-gray-200 bg-gray-100 text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400'
                                "
                            >
                                {{ employee.status }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Department
                        </p>

                        <p class="mt-1 text-sm text-foreground">
                            {{ employee.department }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Designation
                        </p>

                        <p class="mt-1 text-sm text-foreground">
                            {{ employee.designation }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Joining Date
                        </p>

                        <p class="mt-1 text-sm text-foreground">
                            {{ employee.joining_date }}
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-6">
            <Link
                :href="index()"
                class="inline-flex items-center justify-center rounded-md border border-input bg-background px-4 py-2 text-sm font-medium transition-colors hover:bg-muted"
            >
                Back to Employees
            </Link>
        </div>
    </div>
</template>