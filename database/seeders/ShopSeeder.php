<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
   public function run(): void
   {
      $shops = [
         [
            'shop_id' => 1,
            'user_id' => 1,
            'shop_name' => 'Hanni\'s Shop',
            'shop_email' => 'hannisshop@gmail.com',
            'shop_phonenumber' => '011 111 112',
            'shop_address' => 'Seoul, South Korea',
            'shop_description' => 'Welcome to your new favorite corner of the internet, where every piece of jewelry feels like a fairytale come true! 💖🌸   We\'re a Korean-owned shop full of dreamy, dainty, and delightfully pretty things.


Handpicked with love for the soft-hearted. Wear a little magic. Share a little joy. Stay endlessly cute. 💌

#WhimsyInEveryPiece',
            'shop_profilepic' => 'shop-pictures/XuPYcFk6NdXtgnTIlMIkAuyXmbhDczuERz5BXaTp.png',
            'date_created' => '2025-07-07 20:14:37',
            'date_updated' => '2025-07-10 17:01:57',
         ],
         [
            'shop_id' => 2,
            'user_id' => 2,
            'shop_name' => 'Steph Ateiler',
            'shop_email' => 'stephatelier@gmail.com',
            'shop_phonenumber' => '022 222 223',
            'shop_address' => 'Phnom Penh',
            'shop_description' => 'We craft silver jewelry for those who break molds and blur boundaries. Inspired by avant-garde art and modern rebellion, each piece is a statement—raw, refined, and radically unique. Wear your edge. Own your story.',
            'shop_profilepic' => 'shop-pictures/iNTuVBlap7tcmNkFmEI5fIH4VnehRJNJDxhZoMTL.jpg',
            'date_created' => '2025-07-07 20:21:00',
            'date_updated' => '2025-07-08 16:54:37',
         ],
         [
            'shop_id' => 3,
            'user_id' => 3,
            'shop_name' => 'Linh\'s Jewels',
            'shop_email' => 'linhsjewels@gmail.com',
            'shop_phonenumber' => '033 333 334',
            'shop_address' => 'Phnom Penh',
            'shop_description' => null,
            'shop_profilepic' => null,
            'date_created' => '2025-07-08 18:22:01',
            'date_updated' => '2025-07-08 18:22:01',
         ],
         [
            'shop_id' => 4,
            'user_id' => 5,
            'shop_name' => 'TIS GOLD',
            'shop_email' => 'tisgold@gmail.com',
            'shop_phonenumber' => '055 555 556',
            'shop_address' => 'Phnom Penh, Cambodia',
            'shop_description' => 'We sell 24k carat Labubu here, cannot find anywhere else for a good price!',
            'shop_profilepic' => null,
            'date_created' => '2025-07-10 16:53:34',
            'date_updated' => '2025-07-10 16:53:34',
         ],
         [
            'shop_id' => 5,
            'user_id' => 6,
            'shop_name' => 'Ratana Shop',
            'shop_email' => 'ratanashop@gmail.com',
            'shop_phonenumber' => '066 666 666',
            'shop_address' => 'Phnom Penh, Cambodia',
            'shop_description' => 'jndskfvnds',
            'shop_profilepic' => null,
            'date_created' => '2025-07-11 04:40:53',
            'date_updated' => '2025-07-11 04:40:53',
         ],
      ];

      foreach ($shops as $shop) {
         Shop::create($shop);
      }

      // Reset PostgreSQL sequence
      DB::statement("SELECT setval(pg_get_serial_sequence('shop', 'shop_id'), (SELECT MAX(shop_id) FROM shop));");
   }
}
