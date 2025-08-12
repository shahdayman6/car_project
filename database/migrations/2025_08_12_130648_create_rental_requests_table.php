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
    Schema::create('rental_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('rental_id')->constrained()->onDelete('cascade'); // ربط بالإيجار
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ربط بالمستخدم
        $table->string('car_type')->nullable();
        $table->date('start_date');
        $table->date('end_date');
        $table->decimal('total_price', 8, 2);
        $table->string('payment_type')->nullable(); // لو حابة تخزني نوع الدفع
        $table->text('notes')->nullable(); // ملاحظات إضافية لو حابة
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_requests');
    }
};
