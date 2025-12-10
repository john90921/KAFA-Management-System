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
            $table->foreignId('role_id'); // role id for user registered in the system
            $table->string('user_name'); // user name
            $table->string('user_ic', 12); // user ic only contain 12 digit
            $table->string('email')->unique(); // user email
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // user password
            $table->string('user_gender'); // user gender
            $table->string('user_contact'); // user contact
            $table->string('user_verification'); // user verification path
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
