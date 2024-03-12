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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('librarian_id')->nullable();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('birthday')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('sex')->nullable();
            $table->string('religion')->nullable();
            $table->text('blood_group')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('marital_status')->nullable();
            $table->string('qualification')->nullable();
            $table->string('certificate')->nullable();
            $table->string('additional_document')->nullable();
            $table->string('additional_document2')->nullable();
            $table->string('nysc_certificate')->nullable();
            $table->string('school_attended')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->enum('role', ['admin', 'user', 'parent', 'student', 'librarian'])->default('user');
            $table->enum('status',['active','inactive'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
            