<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
   {
      Schema::create('product', function (Blueprint $table) {
         $table->id('product_id');
         $table->unsignedBigInteger('shop_id');
         $table->string('product_name', 100);
         $table->string('product_category', 50)->nullable();
         $table->decimal('product_price', 10, 2);
         $table->text('product_description')->nullable();
         $table->string('product_images')->nullable();
         $table->tinyInteger('in_stock')->default(1);
         $table->timestamp('date_created')->nullable();
         $table->timestamp('date_updated')->nullable();

         $table->foreign('shop_id')->references('shop_id')->on('shop')->onDelete('cascade');
      });

      Schema::create('product_images', function (Blueprint $table) {
         $table->id('image_id');
         $table->unsignedBigInteger('product_id');
         $table->string('image_path');
         $table->timestamps();

         $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
      });
   }

   public function down(): void
   {
      Schema::dropIfExists('product_images');
      Schema::dropIfExists('product');
   }
};
