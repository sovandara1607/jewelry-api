<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
   public function run(): void
   {
      // Using placeholder images from picsum.photos for seeding
      // Each product gets unique placeholder images based on seed number
      $productImages = [
         ['image_id' => 1, 'product_id' => 1, 'image_path' => 'https://picsum.photos/seed/jewelry1/400/400', 'created_at' => '2025-07-07 13:16:25', 'updated_at' => '2025-07-07 13:16:25'],
         ['image_id' => 2, 'product_id' => 1, 'image_path' => 'https://picsum.photos/seed/jewelry2/400/400', 'created_at' => '2025-07-07 13:16:25', 'updated_at' => '2025-07-07 13:16:25'],
         ['image_id' => 3, 'product_id' => 2, 'image_path' => 'https://picsum.photos/seed/jewelry3/400/400', 'created_at' => '2025-07-07 13:18:32', 'updated_at' => '2025-07-07 13:18:32'],
         ['image_id' => 4, 'product_id' => 3, 'image_path' => 'https://picsum.photos/seed/jewelry4/400/400', 'created_at' => '2025-07-07 13:22:14', 'updated_at' => '2025-07-07 13:22:14'],
         ['image_id' => 5, 'product_id' => 4, 'image_path' => 'https://picsum.photos/seed/jewelry5/400/400', 'created_at' => '2025-07-07 14:56:02', 'updated_at' => '2025-07-07 14:56:02'],
         ['image_id' => 7, 'product_id' => 6, 'image_path' => 'https://picsum.photos/seed/jewelry6/400/400', 'created_at' => '2025-07-08 04:25:14', 'updated_at' => '2025-07-08 04:25:14'],
         ['image_id' => 8, 'product_id' => 7, 'image_path' => 'https://picsum.photos/seed/jewelry7/400/400', 'created_at' => '2025-07-08 09:48:39', 'updated_at' => '2025-07-08 09:48:39'],
         ['image_id' => 9, 'product_id' => 7, 'image_path' => 'https://picsum.photos/seed/jewelry8/400/400', 'created_at' => '2025-07-08 09:48:39', 'updated_at' => '2025-07-08 09:48:39'],
         ['image_id' => 10, 'product_id' => 7, 'image_path' => 'https://picsum.photos/seed/jewelry9/400/400', 'created_at' => '2025-07-08 09:48:39', 'updated_at' => '2025-07-08 09:48:39'],
         ['image_id' => 12, 'product_id' => 9, 'image_path' => 'https://picsum.photos/seed/jewelry10/400/400', 'created_at' => '2025-07-10 09:58:32', 'updated_at' => '2025-07-10 09:58:32'],
         ['image_id' => 13, 'product_id' => 9, 'image_path' => 'https://picsum.photos/seed/jewelry11/400/400', 'created_at' => '2025-07-10 09:58:32', 'updated_at' => '2025-07-10 09:58:32'],
         ['image_id' => 17, 'product_id' => 10, 'image_path' => 'https://picsum.photos/seed/jewelry12/400/400', 'created_at' => '2025-07-10 12:29:48', 'updated_at' => '2025-07-10 12:29:48'],
         ['image_id' => 18, 'product_id' => 10, 'image_path' => 'https://picsum.photos/seed/jewelry13/400/400', 'created_at' => '2025-07-10 12:29:48', 'updated_at' => '2025-07-10 12:29:48'],
         ['image_id' => 19, 'product_id' => 10, 'image_path' => 'https://picsum.photos/seed/jewelry14/400/400', 'created_at' => '2025-07-10 12:29:48', 'updated_at' => '2025-07-10 12:29:48'],
         ['image_id' => 21, 'product_id' => 11, 'image_path' => 'https://picsum.photos/seed/jewelry15/400/400', 'created_at' => '2025-07-10 21:41:54', 'updated_at' => '2025-07-10 21:41:54'],
      ];

      foreach ($productImages as $image) {
         ProductImage::create($image);
      }

      // Reset PostgreSQL sequence
      DB::statement("SELECT setval(pg_get_serial_sequence('product_images', 'image_id'), (SELECT MAX(image_id) FROM product_images));");
   }
}