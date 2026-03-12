<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UpdatedProductSeeder extends Seeder
{
   public function run(): void
   {
      $products = [
         [
            'product_id' => 1,
            'product_name' => 'Orchid Necklace',
            'product_category' => 'necklaces',
            'product_price' => 80.00,
            'product_description' => '925 Sterling Silver Orchid Flower Necklace Pendant with 18" Box Chain, Nickle Free Hypoallergenic for Sensitive Skin, Island Tropical Jewelry with Gift Box.',
            'product_images' => null,
            'in_stock' => 1,
            'shop_id' => 1,
            'date_created' => '2025-07-07 20:16:25',
            'date_updated' => '2025-07-10 09:41:09',
         ],
         [
            'product_id' => 2,
            'product_name' => 'Aphrodite Necklace',
            'product_category' => 'necklaces',
            'product_price' => 80.00,
            'product_description' => 'Aphrodite, the Goddess of Love and Beauty, is embodied in this gorgeous sterling silver, orchid, and ruby necklace. Everything about this piece has been hand fabricated. From piercing the petals from a sheet of silver, to forming them and soldering them together, to creating the bail and connections for the ruby teardrop. This piece is perfect for daily wear or for an evening out. Comes with an 18 inch sterling silver chain',
            'product_images' => null,
            'in_stock' => 0,
            'shop_id' => 1,
            'date_created' => '2025-07-07 20:18:32',
            'date_updated' => '2025-07-07 20:19:44',
         ],
         [
            'product_id' => 3,
            'product_name' => 'Metal Chain Bracelet Cuff',
            'product_category' => 'bracelets',
            'product_price' => 800.00,
            'product_description' => 'Sterling 925 silver metal chain bracelet cuff, using snap clasp.',
            'product_images' => null,
            'in_stock' => 0,
            'shop_id' => 2,
            'date_created' => '2025-07-07 20:22:14',
            'date_updated' => '2025-07-10 19:27:54',
         ],
         [
            'product_id' => 4,
            'product_name' => 'Athena Bracelet',
            'product_category' => 'bracelets',
            'product_price' => 60.00,
            'product_description' => 'A stunning array of natural stones—mother of pearl, aventurine, black and white agate, tiger\'s eye, moonstone, and abalone shell—come together on a single silver bracelet, each one showcasing its unique beauty. The black antiqued silver and hammered texture bring a raw, unrefined edge to the piece, echoing Athena\'s natural essence and highlighting the timeless allure of these stones. Materials: silver plated brass,  mother of pearl, aventurine, tiger eye stone, moonstone, agate, abalone shell Measurements: 178mm/7.00" in length We use natural stone and each piece is distinct, with variations in color, clarity and inclusion patterns. These characteristics define each stone\'s unique appearance.',
            'product_images' => null,
            'in_stock' => 0,
            'shop_id' => 1,
            'date_created' => '2025-07-07 21:56:02',
            'date_updated' => '2025-07-08 09:23:11',
         ],
         [
            'product_id' => 6,
            'product_name' => 'Modern Chatelaine',
            'product_category' => 'other',
            'product_price' => 99.00,
            'product_description' => 'Modern chatelaine to match with your outfit, sterling silver 925. Can be used as a keychain as well.',
            'product_images' => null,
            'in_stock' => 1,
            'shop_id' => 2,
            'date_created' => '2025-07-08 11:25:14',
            'date_updated' => '2025-07-08 17:49:00',
         ],
         [
            'product_id' => 7,
            'product_name' => 'Silver Niobe Ring',
            'product_category' => 'rings',
            'product_price' => 180.00,
            'product_description' => 'NIOBE ring is a solid structure that emerges from the stone, retaining its texture impressed. Its thick shape is cut at the corners and curves laterally in strong and harmonious lines.',
            'product_images' => null,
            'in_stock' => 0,
            'shop_id' => 2,
            'date_created' => '2025-07-08 16:48:39',
            'date_updated' => '2025-07-11 10:09:04',
         ],
         [
            'product_id' => 9,
            'product_name' => 'Heart Earrings',
            'product_category' => 'earrings',
            'product_price' => 150.00,
            'product_description' => 'The Petra earrings offer a polished silver-toned design, featuring an asymmetric heart-shaped silhouette, recalling Vivienne\'s affection for humanity and the planet. The piece offers a contrasting gold-tone orb motif in the centre, which represents tradition, encircled by the celestial rings of Saturn, representing the future.',
            'product_images' => null,
            'in_stock' => 1,
            'shop_id' => 1,
            'date_created' => '2025-07-10 16:58:32',
            'date_updated' => '2025-07-11 04:45:57',
         ],
         [
            'product_id' => 10,
            'product_name' => 'Flower Earrings',
            'product_category' => 'earrings',
            'product_price' => 350.00,
            'product_description' => 'Beautiful silver orchid flower earrings, made by hand with love.',
            'product_images' => null,
            'in_stock' => 1,
            'shop_id' => 2,
            'date_created' => '2025-07-10 19:29:48',
            'date_updated' => '2025-07-10 19:29:48',
         ],
         [
            'product_id' => 11,
            'product_name' => 'Cutie Earrings',
            'product_category' => 'earrings',
            'product_price' => 500.00,
            'product_description' => 'Diamond earrings for everyday wear',
            'product_images' => null,
            'in_stock' => 1,
            'shop_id' => 5,
            'date_created' => '2025-07-11 04:41:54',
            'date_updated' => '2025-07-11 04:41:54',
         ],
      ];

      foreach ($products as $product) {
         Product::create($product);
      }

      // Reset PostgreSQL sequence
      DB::statement("SELECT setval(pg_get_serial_sequence('product', 'product_id'), (SELECT MAX(product_id) FROM product));");
   }
}
