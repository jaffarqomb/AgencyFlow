<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table): void {
            $table->foreignId('department_id')
                ->nullable()
                ->after('team_id')
                ->constrained('departments')
                ->nullOnDelete();
        });

        DB::table('employees')
            ->select('department')
            ->whereNotNull('department')
            ->where('department', '!=', '')
            ->distinct()
            ->orderBy('department')
            ->pluck('department')
            ->each(function (string $departmentName): void {
                $departmentId = DB::table('departments')->insertGetId([
                    'name' => $departmentName,
                    'slug' => str($departmentName)->slug()->toString(),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('employees')
                    ->where('department', $departmentName)
                    ->update(['department_id' => $departmentId]);
            });

        Schema::table('employees', function (Blueprint $table): void {
            $table->dropColumn('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table): void {
            $table->string('department')->nullable();
        });

        DB::table('employees')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->select('employees.id', 'departments.name')
            ->get()
            ->each(function (object $employee): void {
                DB::table('employees')
                    ->where('id', $employee->id)
                    ->update(['department' => $employee->name]);
            });

        Schema::table('employees', function (Blueprint $table): void {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });

        Schema::dropIfExists('departments');
    }
};
