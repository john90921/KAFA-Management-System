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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id'); // user's id
            $table->string('notice_title', 50); // notice title
            $table->string('notice_text', 200); // notice description
            $table->string('notice_poster'); // notice poster path
            $table->date('notice_submission_date'); // notice submit date
            $table->string('notice_status'); // notice approval status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
