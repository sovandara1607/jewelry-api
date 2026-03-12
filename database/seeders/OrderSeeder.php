<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
   public function run(): void
   {
      $orders = [
         ['order_id' => 1, 'user_id' => 2, 'order_date' => '2025-07-07 20:19:44', 'total_amount' => 80.00, 'status' => 'Confirmed', 'delivery_address' => 'No address provided', 'date_created' => '2025-07-07 20:19:44', 'date_updated' => '2025-07-07 20:19:44'],
         ['order_id' => 2, 'user_id' => 2, 'order_date' => '2025-07-08 09:23:11', 'total_amount' => 60.00, 'status' => 'Confirmed', 'delivery_address' => 'No address provided', 'date_created' => '2025-07-08 09:23:11', 'date_updated' => '2025-07-08 09:56:25'],
         ['order_id' => 3, 'user_id' => 2, 'order_date' => '2025-07-08 11:28:13', 'total_amount' => 50.00, 'status' => 'Rejected', 'delivery_address' => 'No address provided', 'date_created' => '2025-07-08 11:28:13', 'date_updated' => '2025-07-08 11:32:41'],
         ['order_id' => 4, 'user_id' => 3, 'order_date' => '2025-07-08 16:00:59', 'total_amount' => 99.00, 'status' => 'Rejected', 'delivery_address' => 'No address provided', 'date_created' => '2025-07-08 16:00:59', 'date_updated' => '2025-07-08 17:49:00'],
         ['order_id' => 5, 'user_id' => 3, 'order_date' => '2025-07-08 17:26:18', 'total_amount' => 800.00, 'status' => 'Rejected', 'delivery_address' => 'Phnom Penh', 'date_created' => '2025-07-08 17:26:18', 'date_updated' => '2025-07-08 17:27:40'],
         ['order_id' => 6, 'user_id' => 1, 'order_date' => '2025-07-08 17:47:45', 'total_amount' => 180.00, 'status' => 'Rejected', 'delivery_address' => 'Phnom Penh', 'date_created' => '2025-07-08 17:47:45', 'date_updated' => '2025-07-08 17:49:03'],
         ['order_id' => 7, 'user_id' => 2, 'order_date' => '2025-07-08 17:49:14', 'total_amount' => 80.00, 'status' => 'Rejected', 'delivery_address' => 'No address provided', 'date_created' => '2025-07-08 17:49:14', 'date_updated' => '2025-07-08 18:09:01'],
         ['order_id' => 8, 'user_id' => 2, 'order_date' => '2025-07-10 09:26:51', 'total_amount' => 80.00, 'status' => 'Rejected', 'delivery_address' => 'Phnom Penh', 'date_created' => '2025-07-10 09:26:51', 'date_updated' => '2025-07-10 09:41:09'],
         ['order_id' => 9, 'user_id' => 5, 'order_date' => '2025-07-10 16:55:34', 'total_amount' => 180.00, 'status' => 'Rejected', 'delivery_address' => 'Phnom Penh', 'date_created' => '2025-07-10 16:55:34', 'date_updated' => '2025-07-10 16:56:43'],
         ['order_id' => 10, 'user_id' => 1, 'order_date' => '2025-07-10 19:27:54', 'total_amount' => 800.00, 'status' => 'Confirmed', 'delivery_address' => 'Phnom Penh', 'date_created' => '2025-07-10 19:27:54', 'date_updated' => '2025-07-10 19:28:16'],
         ['order_id' => 11, 'user_id' => 6, 'order_date' => '2025-07-11 04:39:28', 'total_amount' => 150.00, 'status' => 'Rejected', 'delivery_address' => 'Phnom Penh', 'date_created' => '2025-07-11 04:39:28', 'date_updated' => '2025-07-11 04:45:57'],
         ['order_id' => 12, 'user_id' => 1, 'order_date' => '2025-07-11 10:09:04', 'total_amount' => 180.00, 'status' => 'Confirmed', 'delivery_address' => 'Phnom Penh', 'date_created' => '2025-07-11 10:09:04', 'date_updated' => '2025-07-11 10:09:37'],
      ];

      foreach ($orders as $order) {
         Order::create($order);
      }

      // Reset PostgreSQL sequence
      DB::statement("SELECT setval(pg_get_serial_sequence('orders', 'order_id'), (SELECT MAX(order_id) FROM orders));");
   }
}
