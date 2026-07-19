<script setup lang="ts">
import { index, store } from '@/routes/employees';
import type { EmployeeStatusOption } from '@/types/employee';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    statuses: EmployeeStatusOption[];
}>();

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    phone: '',
    address: '',
    date_of_birth: '',
    joining_date: '',
    designation: '',
    department: '',
    status: '',
});

const submit = (): void => {
    form.submit(store());
};
</script>

<template>
    <Head title="Create Employee" />

    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight">
                Create Employee
            </h1>

            <p class="text-sm text-muted-foreground">
                Add a new employee and user account.
            </p>
        </div>

        <form
            class="space-y-6"
            @submit.prevent="submit"
        >
            <div
                class="grid gap-6 rounded-lg border border-border bg-card p-6 md:grid-cols-2"
            >
                <div class="space-y-2">
                    <label
                        for="name"
                        class="text-sm font-medium"
                    >
                        Full Name
                    </label>

                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        autocomplete="name"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors placeholder:text-muted-foreground focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.name"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.name }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        for="email"
                        class="text-sm font-medium"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors placeholder:text-muted-foreground focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.email"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.email }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        for="password"
                        class="text-sm font-medium"
                    >
                        Password
                    </label>

                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="new-password"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors placeholder:text-muted-foreground focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.password"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        for="password_confirmation"
                        class="text-sm font-medium"
                    >
                        Confirm Password
                    </label>

                    <input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors placeholder:text-muted-foreground focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />
                </div>

                <div class="space-y-2">
                    <label
                        for="phone"
                        class="text-sm font-medium"
                    >
                        Phone
                    </label>

                    <input
                        id="phone"
                        v-model="form.phone"
                        type="text"
                        autocomplete="tel"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors placeholder:text-muted-foreground focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.phone"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.phone }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        for="status"
                        class="text-sm font-medium"
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        v-model="form.status"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors focus:border-ring focus:ring-2 focus:ring-ring/20"
                    >
                        <option
                            value=""
                            disabled
                        >
                            Select a status
                        </option>

                        <option
                            v-for="status in statuses"
                            :key="status.value"
                            :value="status.value"
                        >
                            {{ status.label }}
                        </option>
                    </select>

                    <p
                        v-if="form.errors.status"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.status }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        for="date_of_birth"
                        class="text-sm font-medium"
                    >
                        Date of Birth
                    </label>

                    <input
                        id="date_of_birth"
                        v-model="form.date_of_birth"
                        type="date"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.date_of_birth"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.date_of_birth }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        for="joining_date"
                        class="text-sm font-medium"
                    >
                        Joining Date
                    </label>

                    <input
                        id="joining_date"
                        v-model="form.joining_date"
                        type="date"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.joining_date"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.joining_date }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        for="department"
                        class="text-sm font-medium"
                    >
                        Department
                    </label>

                    <input
                        id="department"
                        v-model="form.department"
                        type="text"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors placeholder:text-muted-foreground focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.department"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.department }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        for="designation"
                        class="text-sm font-medium"
                    >
                        Designation
                    </label>

                    <input
                        id="designation"
                        v-model="form.designation"
                        type="text"
                        class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors placeholder:text-muted-foreground focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.designation"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.designation }}
                    </p>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label
                        for="address"
                        class="text-sm font-medium"
                    >
                        Address
                    </label>

                    <textarea
                        id="address"
                        v-model="form.address"
                        rows="4"
                        class="w-full resize-y rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm outline-none transition-colors placeholder:text-muted-foreground focus:border-ring focus:ring-2 focus:ring-ring/20"
                    />

                    <p
                        v-if="form.errors.address"
                        class="text-sm text-destructive"
                    >
                        {{ form.errors.address }}
                    </p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <Link
                    :href="index()"
                    class="rounded-md border border-input bg-background px-4 py-2 text-sm font-medium transition-colors hover:bg-muted"
                >
                    Cancel
                </Link>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    {{ form.processing ? 'Creating...' : 'Create Employee' }}
                </button>
            </div>
        </form>
    </div>
</template>