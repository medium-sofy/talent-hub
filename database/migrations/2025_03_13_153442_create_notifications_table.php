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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Use UUID for the primary key
            $table->string('notifiable_type'); // (e.g., App\Models\User)
            $table->unsignedBigInteger('notifiable_id'); 
            $table->text('data'); 
            $table->timestamp('read_at')->nullable(); 
            $table->timestamps();
        

            $table->index(['notifiable_type', 'notifiable_id']);
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
