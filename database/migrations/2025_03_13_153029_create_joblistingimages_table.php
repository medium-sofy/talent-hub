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
        Schema::create('job_listing_images', function (Blueprint $table) {
            $table->id();
            $table->id();
            $table->unsignedBigInteger('job_listing_id');
            $table->text('path');
            $table->timestamps();

            $table->foreign('job_listing_id')->references('id')->on('job_listings')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listing_images');
    }
};
