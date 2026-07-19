import type { User } from './auth';

/**
 * Represents an employee record returned by Laravel.
 */
export interface Employee {
    id: number;
    user_id: number;
    employee_id: string;
    phone: string;
    address: string | null;
    date_of_birth: string;
    joining_date: string;
    designation: string;
    department: string;
    status: 'active' | 'inactive';
    created_at: string;
    updated_at: string;
    user: User;
}

/**
 * Represents an employee status option used by forms.
 */
export interface EmployeeStatusOption {
    value: 'active' | 'inactive';
    label: string;
}

/**
 * Represents one Laravel paginator navigation link.
 */
export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

/**
 * Represents Laravel's paginated employee response.
 */
export interface PaginatedEmployees {
    current_page: number;
    data: Employee[];
    first_page_url: string;
    from: number | null;
    last_page: number;
    last_page_url: string;
    links: PaginationLink[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number | null;
    total: number;
}