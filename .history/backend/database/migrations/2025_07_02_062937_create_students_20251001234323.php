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
            $table->integer('age')->nullable();
            $table->string('contact')->nullable();
            $table->string('lrn');
            $table->string('emergency_contact')->nullable();
            $table->date('birthdate');
            $table->string('signature')->nullable();
            $table->string('image')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('year_level')->nullable();
            $table->foreignId('section_id');
            $table->foreignId('strand_id');
            $table->string('qr_token')->nullable();
            $table->string('photo_position')->nullable(); 
            $table->string('signature_position')->nullable(); 
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
