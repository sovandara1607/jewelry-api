<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
   public function Dashboard()
   {
      return view('Management.Dashboard');
   }

   public function AllProducts()
   {
      $products = DB::select("
            SELECT product.product_id, product.product_name, product.product_category,
                   product.product_price, product.in_stock, shop.shop_name,
                   (SELECT pi.image_path FROM product_images pi
                    WHERE pi.product_id = product.product_id LIMIT 1) AS product_images
            FROM product
            INNER JOIN shop ON shop.shop_id = product.shop_id
            ORDER BY product.product_name ASC
        ");

      return view('Management.ProductManagement', ['vdata' => $products]);
   }

   public function search(Request $req)
   {
      $search = $req->input('search');
      $products = DB::table('product')
         ->join('shop', 'shop.shop_id', '=', 'product.shop_id')
         ->select(
            'product.product_id',
            'product.product_name',
            'product.product_category',
            'product.product_price',
            'product.in_stock',
            'shop.shop_name',
            DB::raw('NULL as product_images')
         )
         ->where('product.product_name', 'like', '%' . $search . '%')
         ->orWhere('product.product_category', 'like', '%' . $search . '%')
         ->get();

      return view('Management.ProductManagement', ['vdata' => $products]);
   }

   public function filter_Bracelet()
   {
      return $this->filterByCategory('Bracelet');
   }

   public function filter_Brooch()
   {
      return $this->filterByCategory('Brooch');
   }

   public function filter_Earring()
   {
      return $this->filterByCategory('Earring');
   }

   public function filter_Necklace()
   {
      return $this->filterByCategory('Necklace');
   }

   public function filter_Ring()
   {
      return $this->filterByCategory('Ring');
   }

   private function filterByCategory(string $category)
   {
      $products = DB::table('product')
         ->join('shop', 'shop.shop_id', '=', 'product.shop_id')
         ->select(
            'product.product_id',
            'product.product_name',
            'product.product_category',
            'product.product_price',
            'product.in_stock',
            'shop.shop_name',
            DB::raw('NULL as product_images')
         )
         ->where('product.product_category', 'like', $category . '%')
         ->get();

      return view('Management.ProductManagement', ['vdata' => $products]);
   }

   public function buttonOne()
   {
      $products = DB::table('product')
         ->join('shop', 'shop.shop_id', '=', 'product.shop_id')
         ->select(
            'product.product_id',
            'product.product_name',
            'product.product_category',
            'product.product_price',
            'product.in_stock',
            'shop.shop_name',
            DB::raw('NULL as product_images')
         )
         ->orderBy('product.product_name', 'asc')
         ->paginate(10, ['*'], 'page', 1);

      return view('Management.ProductManagement', ['vdata' => $products]);
   }

   public function buttonNext()
   {
      $page = request()->input('page', 2);
      $products = DB::table('product')
         ->join('shop', 'shop.shop_id', '=', 'product.shop_id')
         ->select(
            'product.product_id',
            'product.product_name',
            'product.product_category',
            'product.product_price',
            'product.in_stock',
            'shop.shop_name',
            DB::raw('NULL as product_images')
         )
         ->orderBy('product.product_name', 'asc')
         ->paginate(10, ['*'], 'page', $page);

      return view('Management.ProductManagement', ['vdata' => $products]);
   }
}
