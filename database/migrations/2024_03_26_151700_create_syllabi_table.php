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
        Schema::create('syllabi', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('academic_syllabus_code')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
            $table->unsignedBigInteger('subjects_id')->nullable();
            $table->foreign('subjects_id')->references('id')->on('school_subjects')->onDelete('set null');
            $table->string('uploaded_by')->nullable();
            $table->string('session')->nullable();
            $table->string('description')->nullable();
            $table->string('file_name')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syllabi');
    }
};
