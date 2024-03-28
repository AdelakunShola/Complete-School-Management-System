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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('license')->nullable();
            $table->string('license_number')->nullable();
            $table->string('license_expiry_date')->nullable();
            $table->string('guarantor_name')->nullable();
            $table->string('guarantor_phone')->nullable();
            $table->string('guarantor_address')->nullable();
            $table->string('guarantor_id_card')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
