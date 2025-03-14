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
        Schema::create('joblistings', function (Blueprint $table) {
            $table->id();
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->text('benefits')->nullable();
            $table->string('location');
            $table->unsignedBigInteger('category_id');
            $table->enum('workplace', ['remote', 'onsite', 'hybrid']);
            $table->enum('job_type', ['Full-time', 'Part-time', 'freelance']);
            $table->unsignedInteger('upper_salary')->nullable();
            $table->unsignedInteger('lower_salary')->nullable();
            $table->dateTime('application_deadline')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joblistings');
    }
};
