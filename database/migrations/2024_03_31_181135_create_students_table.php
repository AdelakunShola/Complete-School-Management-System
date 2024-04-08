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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('birthday')->nullable();
            $table->string('age')->nullable();
            $table->string('tribe')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('sex')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('nationality')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_issue_date')->nullable();
            $table->string('card_expiry_date')->nullable();
            $table->string('physical_handicap')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('prev_sch_attended')->nullable();
            $table->string('prev_sch_address')->nullable();
            $table->string('date_of_leaving_prev_sch')->nullable();
            $table->string('reason_of_leaving_prev_sch')->nullable();
            $table->string('class_in_prev_sch')->nullable();
            $table->string('class_id')->nullable();
            $table->string('section_id')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('transport_id')->nullable();
            $table->string('student_category_id')->nullable();
            $table->string('club_id')->nullable();
            $table->string('house_id')->nullable();
            $table->string('hostel_id')->nullable();
            $table->string('transfer_cert')->nullable();
            $table->string('birth_cert')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
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
        Schema::dropIfExists('students');
    }
};
