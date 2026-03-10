<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
   {
      Schema::create('orders', function (Blueprint $table) {
         $table->id('order_id');
         $table->unsignedBigInteger('user_id')->nullable();
         $table->timestamp('order_date')->nullable();
         $table->decimal('total_amount', 10, 2)->default(0);
         $table->text('delivery_address')->nullable();
         $table->string('status', 50)->default('pending');
         $table->timestamp('date_created')->nullable()->useCurrent();
         $table->timestamp('date_updated')->nullable();

         $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
      });
   }

   public function down(): void
   {
      Schema::dropIfExists('orders');
   }
};
