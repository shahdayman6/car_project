<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');   // المرسل
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // المستقبل
            
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');       // السيارة اللي الرسالة بخصوصها
            
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
