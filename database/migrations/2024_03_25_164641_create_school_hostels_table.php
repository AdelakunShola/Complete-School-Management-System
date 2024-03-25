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
        Schema::create('school_hostels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('hostel_room_id')->nullable();
            $table->foreign('hostel_room_id')->references('id')->on('hostel_rooms')->onDelete('set null');
            $table->unsignedBigInteger('hostel_category_id')->nullable();
            $table->foreign('hostel_category_id')->references('id')->on('hostel_categories')->onDelete('set null');
            $table->string('capacity')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_hostels');
    }
};
