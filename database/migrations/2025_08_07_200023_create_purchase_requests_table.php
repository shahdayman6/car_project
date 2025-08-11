<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // المستخدم اللي اشترى
            $table->string('name');
            $table->string('phone');
            $table->integer('quantity')->default(1);
            $table->enum('payment_type', ['cash', 'installments'])->default('cash');
            $table->text('message')->nullable();
            $table->integer('budget_from')->nullable();
            $table->integer('budget_to')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
