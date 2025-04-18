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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
<<<<<<< HEAD
=======
            $table->string('slug')->unique()->nullable(); // Move this before other columns
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
            $table->text('resume_url')->nullable();
            $table->text('linkedin_profile')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
<<<<<<< HEAD

=======
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
