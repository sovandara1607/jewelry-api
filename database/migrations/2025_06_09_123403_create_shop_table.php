<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
   {
      Schema::create('shop', function (Blueprint $table) {
         $table->id('shop_id');
         $table->unsignedBigInteger('user_id')->nullable();
         $table->string('shop_name');
         $table->string('shop_email')->nullable();
         $table->string('shop_phonenumber')->nullable();
         $table->string('shop_address')->nullable();
         $table->text('shop_description')->nullable();
         $table->string('shop_profilepic')->nullable();
         $table->timestamp('date_created')->nullable();
         $table->timestamp('date_updated')->nullable();

         $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
      });
   }

   public function down(): void
   {
      Schema::dropIfExists('shop');
   }
};
