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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id'); // class id of class that will be assign to the activity
            $table->foreignId('subject_id'); // subject id
            $table->string('activity_name', 30); // activity name
            $table->string('activity_description', 100); // activity description
            $table->time('activity_starttime'); // activity start time
            $table->time('activity_endtime'); // activity end time
            $table->date('activity_date'); // activity date
            $table->string('activity_remarks', 30); // activity remarks
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
