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
       Schema::create('purchase_requests', function (Blueprint $table) {
    $table->id();
    $table->foreignId('car_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->string('phone');
    $table->text('message')->nullable();
    $table->integer('budget_from')->nullable();
    $table->integer('budget_to')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
