<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('purchase_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('car_id');
        $table->string('name');
        $table->string('phone');
        $table->integer('quantity');
        $table->enum('payment_type', ['cash', 'installments']);
        $table->text('message')->nullable();
        $table->timestamps();

        $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
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
