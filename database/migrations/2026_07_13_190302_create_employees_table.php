<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\EmployeeStatus;

return new class extends Migration
{
    /**
     * Create the employees table.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            /*
             * Relationships
             *
             * Each employee record belongs to one user account.
             */

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
             * Employee Information
             */

            $table->string('employee_id')->unique();

            $table->string('phone', 20);

            $table->text('address')->nullable();

            $table->date('date_of_birth');

            $table->date('joining_date');

            $table->string('designation');

            $table->string('department');

            $table->enum('status', array_column(EmployeeStatus::cases(), 'value'))
                ->default(EmployeeStatus::Active->value);

            $table->timestamps();
        });
    }

    /**
     * Drop the employees table.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};