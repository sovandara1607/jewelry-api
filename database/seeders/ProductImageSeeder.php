<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
   public function run(): void
   {
      // Clear existing records first
      DB::statement('TRUNCATE TABLE product_images RESTART IDENTITY CASCADE');

      // Original database image paths from production
      $productImages = [
         ['image_id' => 1, 'product_id' => 1, 'image_path' => 'product-images/X6963g9br4TdOVFvW9O2QLlMJOc5W7nWqGySP2AA.jpg', 'created_at' => '2025-07-07 13:16:25', 'updated_at' => '2025-07-07 13:16:25'],
         ['image_id' => 2, 'product_id' => 1, 'image_path' => 'product-images/lEvrHuJO2DnnKH3EesyYMbZ57yZYmt9Cv3kSMaYJ.jpg', 'created_at' => '2025-07-07 13:16:25', 'updated_at' => '2025-07-07 13:16:25'],
         ['image_id' => 3, 'product_id' => 2, 'image_path' => 'product-images/ilS0rpUZvLXUEiQqv6JEZLCODU0PhcVWrMUWyoRZ.jpg', 'created_at' => '2025-07-07 13:18:32', 'updated_at' => '2025-07-07 13:18:32'],
         ['image_id' => 4, 'product_id' => 3, 'image_path' => 'product-images/MIqmVrn8IHym4ECxwX9LBfUqv005WMx64alztCGt.png', 'created_at' => '2025-07-07 13:22:14', 'updated_at' => '2025-07-07 13:22:14'],
         ['image_id' => 5, 'product_id' => 4, 'image_path' => 'product-images/0QwKQfHJQwYzLU1Sti3aULsztGnr4EkbzkGQL7EM.jpg', 'created_at' => '2025-07-07 14:56:02', 'updated_at' => '2025-07-07 14:56:02'],
         ['image_id' => 7, 'product_id' => 6, 'image_path' => 'product-images/DOw2HuQ2rDplsJnHkwFeLJJKXgx07jS1X4ZRm4aY.jpg', 'created_at' => '2025-07-08 04:25:14', 'updated_at' => '2025-07-08 04:25:14'],
         ['image_id' => 8, 'product_id' => 7, 'image_path' => 'product-images/IJvrQY1yAiIHbRhwPlEXPLSKrlQuR1qOxyjj2nUh.webp', 'created_at' => '2025-07-08 09:48:39', 'updated_at' => '2025-07-08 09:48:39'],
         ['image_id' => 9, 'product_id' => 7, 'image_path' => 'product-images/EkhyMaFjvKrUvOKpLPQLi6ukdHts2WbCt9hk9lix.webp', 'created_at' => '2025-07-08 09:48:39', 'updated_at' => '2025-07-08 09:48:39'],
         ['image_id' => 10, 'product_id' => 7, 'image_path' => 'product-images/fh9Xcf0jWb9Xz0qSTRJq1D7htwBW63qGft0dwkXv.webp', 'created_at' => '2025-07-08 09:48:39', 'updated_at' => '2025-07-08 09:48:39'],
         ['image_id' => 12, 'product_id' => 9, 'image_path' => 'product-images/bbab5FjhkDhfr5yBCJAzknni5Stvc4hR1th65UtO.jpg', 'created_at' => '2025-07-10 09:58:32', 'updated_at' => '2025-07-10 09:58:32'],
         ['image_id' => 13, 'product_id' => 9, 'image_path' => 'product-images/ILTArpUu1TIrg7BAAQzXbeXFZoOk4VCVIO7xzZI1.jpg', 'created_at' => '2025-07-10 09:58:32', 'updated_at' => '2025-07-10 09:58:32'],
         ['image_id' => 17, 'product_id' => 10, 'image_path' => 'product-images/cDSofRM5Jd1M9M6LFfQXKHCFYfGcTjAgCnb4W6HF.jpg', 'created_at' => '2025-07-10 12:29:48', 'updated_at' => '2025-07-10 12:29:48'],
         ['image_id' => 18, 'product_id' => 10, 'image_path' => 'product-images/LAKzHR7pW0bwdWumcqq1DZv8nZ017keTf8YH59eP.jpg', 'created_at' => '2025-07-10 12:29:48', 'updated_at' => '2025-07-10 12:29:48'],
         ['image_id' => 19, 'product_id' => 10, 'image_path' => 'product-images/2vyagQ7fXLZgGjTHFnqOBLn8zdbnNk8QvUmKCfDi.jpg', 'created_at' => '2025-07-10 12:29:48', 'updated_at' => '2025-07-10 12:29:48'],
         ['image_id' => 21, 'product_id' => 11, 'image_path' => 'product-images/g5f6h4yXps9yv1ljBhfYixPDt3YC2jeKJgZqgTGQ.png', 'created_at' => '2025-07-10 21:41:54', 'updated_at' => '2025-07-10 21:41:54'],
      ];

      foreach ($productImages as $image) {
         ProductImage::create($image);
      }

      // Reset PostgreSQL sequence to match the highest ID
      DB::statement("SELECT setval(pg_get_serial_sequence('product_images', 'image_id'), (SELECT MAX(image_id) FROM product_images));");
   }
}