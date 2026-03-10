<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
   public function AllOrders()
   {
      $orders = DB::select("
            SELECT order_id, total_amount, delivery_address, date_created, status
            FROM orders
            ORDER BY date_created DESC
        ");

      return view('Management.OrderManagement', ['vdata' => $orders]);
   }

   public function ViewOrderItems($oID)
   {
      $vdata = DB::select("
            SELECT
                orders.order_id,
                orders.date_created AS order_date,
                orders.delivery_address,
                orders.status,
                orders.total_amount,
                orderitem.product_id,
                orderitem.price,
                orderitem.quantity,
                product.product_name,
                shop.shop_name
            FROM orders
            INNER JOIN orderitem ON orderitem.order_id = orders.order_id
            INNER JOIN product ON product.product_id = orderitem.product_id
            INNER JOIN shop ON shop.shop_id = product.shop_id
            WHERE orders.order_id = ?
        ", [$oID]);

      return view('Management.ViewOrderItem', ['vdata' => $vdata]);
   }
}
