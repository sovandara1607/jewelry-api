<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class BackEndAPIController extends Controller
{

    //AdminProductController APIs----
    public function getAllProductList(){
        $productList = DB::select("select 
        product.product_name,
        product.product_category,
        product.product_price,
        product.in_stock,
        shop.shop_name
        FROM product
        INNER JOIN shop ON shop.shop_id = product.shop_id");
    
        return response()->json(
            [
                'product_list'=> $productList
            ],
            200
        );
    }

    public function productSearchList(Request $req){
        $search = $req->input('search');
        $productSearch = DB::table('product')->whereAny([
            'product_name',
            'product_category',
            'product_price'
        ],'like', '%' . $search . '%')->get();

        return response()->json(
            [
                'product_Search'=> $productSearch
            ],
            200
        );
    }

    public function filterProductList(Request $req){
        $category = $req->input('category');
        if($category === 'All'){
             $categorySearched = DB::select("select *
             FROM product
             ");
        }else{        
        $categorySearched  = DB::table('product')->whereAny([
          'product_category'
        ],'like', $category . '%')->get();
    }
        return response()->json(
            [
                'category_Searched'=> $categorySearched
            ],
            200
        );
    }


//AdminOrderController APIs----
    public function getAllOrderList(){
        $orderList = DB::select("select
        order_id,
        total_amount,
        delivery_address,
        date_created,
        status
        FROM orders
        ");

        return response()->json(
            [
                'order_list'=> $orderList
            ],
            200
        );
    }

    public function orderSearchList(Request $req){
        $search = $req->input('search');
        $orderSearched  = DB::table('orders')->whereAny([
            'order_id',
            'delivery_address',
            'date_created',
            'status'
        ],'like', '%' . $search . '%')->get();
        
        return response()->json(
            [
                'order_Searched'=> $orderSearched
            ],
            200
        );
    }

    public function filterOrderList(Request $req){
        $status = $req->input('status');

        if($status === 'All'){
             $statusSearched = DB::select("select *
             FROM orders
             ");
        }else{        
        $statusSearched  = DB::table('orders')->whereAny([
          'status'
        ],'like', $status . '%')->get();
    }
        return response()->json(
            [
                'status_Searched'=> $statusSearched
            ],
            200
        );
    }

    public function ViewOrderItemsList(Request $req){
        
        $v_orderList = DB::select(' SELECT 
                                      orders.order_id,
                                      orders.order_date,
                                      orderitem.product_id,
                                      orderitem.price,
                                      orderitem.quantity,
                                      orders.delivery_address,
                                      orders.status,
                                      orders.total_amount
                                FROM 
                                   orders
                                   INNER JOIN orderitem ON orderitem.order_id = orders.order_id
                                WHERE orders.order_id = ?',[$req->oID]);
        
        return response()->json(
            [
                '$vorderList'=> $v_orderList
            ],
            200
        );
    }


    //AdminShopController APIs----
    public function getAllShopList(){
        $shopList = DB::select("select
        shop_name,
        shop_email,
        shop_phonenumber,
        shop_address
        FROM shop
        ");

        return response()->json([
            'shop_list'=> $shopList
        ],
        200
        );
    }

    public function shopSearchList(Request $req){
        $search = $req->input('search');
        $shopSearched  = DB::table('shop')->whereAny([
            'shop_name'
        ],'like', $search . '%')->get();
        return response()->json([
            'shop_Searched'=> $shopSearched
        ],
        200
        );
    }

    public function filterShopList(Request $req){
        $Sname = $req->input('Sname');

        if($Sname === 'All'){
        $snameSearched = DB::select("select
            shop_name,
            shop_email,
            shop_phonenumber,
            shop_address
            FROM shop
            order by shop_name asc
          
          ");
        }else{
        $snameSearched  = DB::table('shop')->whereAny([
          'shop_name'
        ],'like', $Sname . '%')->get();
      }
      return response()->json([
            'sname_Searched'=> $snameSearched
        ],
        200
        );
    }




    //AdminUserController APIs----
    public function getAllUserList(){
        $userList = DB::select("select
        name,
        email,
        phonenumber
        FROM users order by users.name asc
        ");

        return response()->json([
            'user_list'=> $userList
        ],
        200
        );
    }

    public function userSearchList(Request $req){
        $search = $req->input('search');
        $userSearched  = DB::table('users')->whereAny([
            'name'
        ],'like', '%' . $search . '%')->get();
        return response()->json([
            'user_Searched'=> $userSearched
        ],
        200
        );
    }

    public function filterUserList(Request $req){
        $name = $req->input('name');

        if($name === 'All'){
        $nameSearched = DB::select("select
          name,
          email,
          phonenumber
          FROM users order by users.name asc
          
          ");
        }else{
        $nameSearched  = DB::table('users')->whereAny([
          'name'
        ],'like', $name . '%')->get();
      }
        return response()->json([
            'name_Searched'=> $nameSearched
        ],
        200
        );
    }


}
