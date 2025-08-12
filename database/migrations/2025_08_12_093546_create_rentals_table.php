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
        Schema::create('rentals', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('car_id')->nullable(); // لو مرتبط بعربية عندك
    $table->unsignedBigInteger('user_id'); // مالك الإعلان
    $table->string('title')->nullable();
    $table->text('description')->nullable();
    $table->decimal('price_per_day', 10, 2)->default(0);
    $table->string('location')->nullable();
    $table->json('images')->nullable();
    $table->boolean('available')->default(true);
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
