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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id');
            $table->unsignedBigInteger('candidate_id');
            $table->enum('status', ['pending', 'accepted', 'rejected']);
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('resume_url')->nullable();

            $table->foreign('job_listing_id')->references('id')->on('job_listings')->onDelete('cascade');
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
            $table->unique(['job_listing_id', 'candidate_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
