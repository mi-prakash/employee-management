<?php

use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add the role column to the users table.
     *
     * Every user must have exactly one application role.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {

            $table->string('role')
                ->default(UserRole::Employee->value)
                ->after('email')
                ->index();
        });
    }

    /**
     * Remove the role column.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {

            $table->dropColumn('role');
        });
    }
};