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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id'); // student id
            $table->foreignId('user_id'); // parent id
            $table->foreignId('subject_id'); // subject id
            $table->foreignId('examination_id'); // examination id
            $table->integer('result_marks'); // result's mark
            $table->string('result_feedback', 50); // result's feedback
            $table->char('result_grades'); // grade
            $table->string('result_status'); // result status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
