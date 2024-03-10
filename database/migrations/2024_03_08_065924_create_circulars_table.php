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
        Schema::create('circulars', function (Blueprint $table) {
            $table->id();
            $table->text('circular_title')->nullable();
            $table->text('reference_number')->nullable();
            $table->text('content')->nullable();
            $table->text('circular_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circulars');
    }
};
