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
    Schema::table('cars', function (Blueprint $table) {
        $table->string('color')->nullable();
        $table->enum('condition', ['new', 'used'])->nullable();
        $table->text('description')->nullable();
        $table->unsignedBigInteger('user_id')->nullable();

        // علاقة مع جدول المستخدمين
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
   }


    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('cars', function (Blueprint $table) {
        $table->dropColumn('color');
        $table->dropColumn('condition');
        $table->dropColumn('description');

        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};
