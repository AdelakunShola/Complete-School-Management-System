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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('vehicle_number')->nullable();
            $table->text('vehicle_model')->nullable();
            $table->text('vehicle_quantity')->nullable();
            $table->text('year_made')->nullable();
            $table->text('driver_name')->nullable();
            $table->text('driver_contact')->nullable();
            $table->text('status')->nullable();
            $table->text('description')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
