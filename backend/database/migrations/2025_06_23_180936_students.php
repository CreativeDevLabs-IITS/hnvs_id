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
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffix')->nullable();
            $table->string('barangay');
            $table->string('municipality');
            $table->integer('age');
            $table->string('contact');
            $table->string('lrn');
            $table->string('emergency_contact');
            $table->date('birthdate');
            $table->string('signature')->nullable();
            $table->string('image')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('year_level');
            $table->string('student_id');
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
