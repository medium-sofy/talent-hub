<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {

            $table->string('notifiable_type')->nullable(); 
            $table->unsignedBigInteger('notifiable_id')->nullable(); 


            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {

            $table->dropColumn(['notifiable_type', 'notifiable_id']);
        });
    }
};
