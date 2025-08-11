<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
           $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->integer('price');
            $table->json('images'); // نخزن الصور كمصفوفة JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
