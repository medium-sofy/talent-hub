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
            $table->id();
<<<<<<< HEAD
            $table->unsignedBigInteger('user_id');
            $table->text('message');
            $table->boolean('is_read')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }
=======
            $table->unsignedBigInteger('user_id'); 
            $table->text('message');
            $table->boolean('is_read')->default(false); // Use `is_read` instead of `read_at`
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
