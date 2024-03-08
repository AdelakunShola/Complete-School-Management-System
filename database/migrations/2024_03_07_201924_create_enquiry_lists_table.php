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
        Schema::create('enquiry_lists', function (Blueprint $table) {
            $table->id();
            $table->text('category')->nullable();
            $table->text('mobile')->nullable();
            $table->text('purpose')->nullable();
            $table->text('name')->nullable();
            $table->text('whom_to_meet')->nullable();
            $table->text('email')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_lists');
    }
};
