<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminShopController extends Controller
{
   public function AllShops()
   {
      $shops = DB::select("
            SELECT shop_name, shop_email, shop_phonenumber, shop_address
            FROM shop
            ORDER BY shop_name ASC
        ");

      return view('Management.ShopManagement', ['vdata' => $shops]);
   }

   public function search(Request $req)
   {
      $search = $req->input('search');
      $shops = DB::table('shop')
         ->select('shop_name', 'shop_email', 'shop_phonenumber', 'shop_address')
         ->where('shop_name', 'like', '%' . $search . '%')
         ->orWhere('shop_email', 'like', '%' . $search . '%')
         ->get();

      return view('Management.ShopManagement', ['vdata' => $shops]);
   }
}
