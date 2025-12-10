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
            $table->foreignId('classroom_id')->nullable(); // classroom id of student class
            $table->foreignId('parent_id'); // user id of parent tht register their child
            $table->string('student_name'); //student name
            $table->string('student_ic', 12); //student ic only contain 12 digit
            $table->integer('student_age'); // student age
            $table->string('student_gender'); // student gender
            $table->string('student_verification'); // student verification path
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
