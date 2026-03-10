<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
   {
      Schema::create('orderitem', function (Blueprint $table) {
         $table->id('orderitem_id');
         $table->unsignedBigInteger('order_id');
         $table->unsignedBigInteger('product_id');
         $table->integer('quantity')->default(1);
         $table->decimal('price', 10, 2);
         $table->timestamp('date_created')->nullable()->useCurrent();
         $table->timestamp('date_updated')->nullable();

         $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
         $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
      });
   }

   public function down(): void
   {
      Schema::dropIfExists('orderitem');
   }
};
