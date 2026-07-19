<script setup lang="ts">
import { create, destroy, edit, show } from '@/routes/employees';
import type { Employee, PaginatedEmployees } from '@/types/employee';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    employees: PaginatedEmployees;
    flash: {
        success?: string | null;
        error?: string | null;
    };
}>();

const deleteEmployee = (employee: Employee): void => {
    const confirmed = window.confirm(
        `Are you sure you want to delete ${employee.user.name}?`,
    );

    if (!confirmed) {
        return;
    }

    router.delete(destroy(employee.id).url, {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Employees" />

    <div class="p-6">
        <div
            v-if="flash.success"
            class="mb-6 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-900 dark:bg-green-950 dark:text-green-400"
        >
            {{ flash.success }}
        </div>

        <div
            v-if="flash.error"
            class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900 dark:bg-red-950 dark:text-red-400"
        >
            {{ flash.error }}
        </div>
        
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Employees</h1>

                <p class="text-sm text-muted-foreground">
                    Manage employee records.
                </p>
            </div>

            <Link
                :href="create()"
                class="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90"
            >
                Add Employee
            </Link>
        </div>

        <div class="overflow-hidden rounded-lg border border-border bg-card">
            <table class="min-w-full">
                <thead class="border-b border-border bg-muted">
                    <tr>
                        <th
                            class="px-4 py-3 text-left text-sm font-medium text-foreground"
                        >
                            Employee ID
                        </th>

                        <th
                            class="px-4 py-3 text-left text-sm font-medium text-foreground"
                        >
                            Name
                        </th>

                        <th
                            class="px-4 py-3 text-left text-sm font-medium text-foreground"
                        >
                            Email
                        </th>

                        <th
                            class="px-4 py-3 text-left text-sm font-medium text-foreground"
                        >
                            Department
                        </th>

                        <th
                            class="px-4 py-3 text-left text-sm font-medium text-foreground"
                        >
                            Designation
                        </th>

                        <th
                            class="px-4 py-3 text-left text-sm font-medium text-foreground"
                        >
                            Status
                        </th>

                        <th
                            class="px-4 py-3 text-right text-sm font-medium text-foreground"
                        >
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="employee in employees.data"
                        :key="employee.id"
                        class="border-b border-border transition-colors last:border-0 hover:bg-muted/50"
                    >
                        <td class="px-4 py-3">
                            {{ employee.employee_id }}
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ employee.user.name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ employee.user.email }}
                        </td>

                        <td class="px-4 py-3">
                            {{ employee.department }}
                        </td>

                        <td class="px-4 py-3">
                            {{ employee.designation }}
                        </td>

                        <td class="px-4 py-3">
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
                        </td>

                        <td class="px-4 py-3 text-right">
                            <Link
                                :href="show(employee.id)"
                                class="mr-3 text-sm font-medium text-primary hover:underline"
                            >
                                View
                            </Link>

                            <Link
                                :href="edit(employee.id)"
                                class="mr-3 text-sm font-medium text-primary hover:underline"
                            >
                                Edit
                            </Link>

                            <button
                                type="button"
                                class="text-sm font-medium text-destructive hover:underline"
                                @click="deleteEmployee(employee)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr v-if="employees.data.length === 0">
                        <td
                            colspan="7"
                            class="px-4 py-10 text-center text-muted-foreground"
                        >
                            No employees found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div
            v-if="employees.last_page > 1"
            class="mt-6 flex items-center justify-between gap-4"
        >
            <p class="text-sm text-muted-foreground">
                Showing {{ employees.from }} to {{ employees.to }} of
                {{ employees.total }} employees
            </p>

            <div class="flex flex-wrap items-center gap-2">
                <template
                    v-for="(link, index) in employees.links"
                    :key="`${link.label}-${index}`"
                >
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        preserve-scroll
                        class="rounded-md border border-border px-3 py-2 text-sm transition-colors hover:bg-muted"
                        :class="{
                            'bg-primary text-primary-foreground hover:bg-primary/90':
                                link.active,
                        }"
                    >
                        <span v-html="link.label" />
                    </Link>

                    <span
                        v-else
                        class="cursor-not-allowed rounded-md border border-border px-3 py-2 text-sm text-muted-foreground opacity-50"
                        v-html="link.label"
                    />
                </template>
            </div>
        </div>

        <div
            v-else
            class="mt-6 text-sm text-muted-foreground"
        >
            Showing {{ employees.from }} to {{ employees.to }} of
            {{ employees.total }} employees
        </div>
    </div>
</template>