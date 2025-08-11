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
            $table->unsignedBigInteger('product_id'); // بدل car_id/spare_part_id
            $table->enum('product_type', ['car', 'spare_part']); // يحدد نوع المنتج
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('phone');
            $table->integer('quantity')->default(1);
            $table->enum('payment_type', ['cash', 'installments'])->default('cash');
            $table->text('message')->nullable();
            $table->integer('budget_from')->nullable();
            $table->integer('budget_to')->nullable();
            $table->timestamps();

            // ممكن تضيف index للبحث
            $table->index(['product_id', 'product_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
