<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
   public function run(): void
   {
      $orderItems = [
         ['orderitem_id' => 1, 'order_id' => 1, 'product_id' => 2, 'quantity' => 1, 'price' => 80.00, 'date_created' => '2025-07-07 20:19:44', 'date_updated' => '2025-07-07 20:19:44'],
         ['orderitem_id' => 2, 'order_id' => 2, 'product_id' => 4, 'quantity' => 1, 'price' => 60.00, 'date_created' => '2025-07-08 09:23:11', 'date_updated' => '2025-07-08 09:23:11'],
         ['orderitem_id' => 3, 'order_id' => 3, 'product_id' => 1, 'quantity' => 1, 'price' => 50.00, 'date_created' => '2025-07-08 11:28:13', 'date_updated' => '2025-07-08 11:28:13'],
         ['orderitem_id' => 4, 'order_id' => 4, 'product_id' => 6, 'quantity' => 1, 'price' => 99.00, 'date_created' => '2025-07-08 16:00:59', 'date_updated' => '2025-07-08 16:00:59'],
         ['orderitem_id' => 5, 'order_id' => 5, 'product_id' => 3, 'quantity' => 1, 'price' => 800.00, 'date_created' => '2025-07-08 17:26:18', 'date_updated' => '2025-07-08 17:26:18'],
         ['orderitem_id' => 6, 'order_id' => 6, 'product_id' => 7, 'quantity' => 1, 'price' => 180.00, 'date_created' => '2025-07-08 17:47:45', 'date_updated' => '2025-07-08 17:47:45'],
         ['orderitem_id' => 7, 'order_id' => 7, 'product_id' => 1, 'quantity' => 1, 'price' => 80.00, 'date_created' => '2025-07-08 17:49:14', 'date_updated' => '2025-07-08 17:49:14'],
         ['orderitem_id' => 8, 'order_id' => 8, 'product_id' => 1, 'quantity' => 1, 'price' => 80.00, 'date_created' => '2025-07-10 09:26:51', 'date_updated' => '2025-07-10 09:26:51'],
         ['orderitem_id' => 9, 'order_id' => 9, 'product_id' => 7, 'quantity' => 1, 'price' => 180.00, 'date_created' => '2025-07-10 16:55:34', 'date_updated' => '2025-07-10 16:55:34'],
         ['orderitem_id' => 10, 'order_id' => 10, 'product_id' => 3, 'quantity' => 1, 'price' => 800.00, 'date_created' => '2025-07-10 19:27:54', 'date_updated' => '2025-07-10 19:27:54'],
         ['orderitem_id' => 11, 'order_id' => 11, 'product_id' => 9, 'quantity' => 1, 'price' => 150.00, 'date_created' => '2025-07-11 04:39:28', 'date_updated' => '2025-07-11 04:39:28'],
         ['orderitem_id' => 12, 'order_id' => 12, 'product_id' => 7, 'quantity' => 1, 'price' => 180.00, 'date_created' => '2025-07-11 10:09:04', 'date_updated' => '2025-07-11 10:09:04'],
      ];

      foreach ($orderItems as $item) {
         OrderItem::create($item);
      }

      // Reset PostgreSQL sequence
      DB::statement("SELECT setval(pg_get_serial_sequence('orderitem', 'orderitem_id'), (SELECT MAX(orderitem_id) FROM orderitem));");
   }
}
