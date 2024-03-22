<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('payroll_code')->nullable();
            $table->string('net_salary')->nullable(); //  $table->decimal('net_salary', 10, 2)->nullable(); Decimal data type for net salary
            $table->json('allowances')->nullable(); // Store allowances as JSON
            $table->json('deductions')->nullable(); // Store deductions as JSON
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};


