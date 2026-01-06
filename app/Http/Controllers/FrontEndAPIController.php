<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FrontEndAPIController extends Controller
{
//CartController
    public function Cartindex()
    {
        $cart = session()->get('cart', []);

        $cartItemsByShop = [];
        $totalAmount = 0;

        foreach ($cart as $id => $details) {
            $shopName = $details['shop_name'];

            if (!isset($cartItemsByShop[$shopName])) {
                $cartItemsByShop[$shopName] = [
                    'shop_name' => $details['shop_name'],
                    'shop_email' => $details['shop_email'],
                    'items' => [] 
                ];
            }
            $cartItemsByShop[$shopName]['items'][$id] = $details;

            $totalAmount += $details['price'];
        }

        return response()->json(
            [
                'cartItemsByShop' => $cartItemsByShop,
                'totalAmount' => $totalAmount
            ],
            200
        );
    }

    
//ProductController
public function showProduct(Product $product)
    {
        $product->load('images');
        $seller = $product->shop; // Assumes a 'shop' relationship exists on the Product model

        return response()->json(
            [
                'product' => $product,
                'seller' => $seller
            ],
            200
        );

    }


public function storeProduct(Request $request)
    {
        $validatedData =Validator::make($request->all(),[
            'product_name' => 'required|string|max:100',
            'product_category' => 'required|string|max:50',
            'product_price' => 'required|numeric|min:0',
            'product_description' => 'nullable|string',
            'product_images' => 'required|array',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240'
        ]);

        if($validatedData->fails()){
            return response()->json(['errors'=>$validatedData->errors()],422);
        }
        $product = Product::create([
            'shop_id' => Auth::user()->shop->shop_id, // Use the correct primary key name
            'product_name' => $validatedData['product_name'],
            'product_category' => $validatedData['product_category'],
            'product_price' => $validatedData['product_price'],
            'product_description' => $validatedData['product_description'],
            'in_stock' => 1,
        ]);
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $path = $file->store('product-images', 'public');

                $product->images()->create([
                    'image_path' => $path,
                    'product_id' => $product->Product_id
                ]);
            }
        }
        return response()->json([
            'message' => 'New listing added successfully!',
            'product'   => $product
        ], 201);
    }

        public function editProduct(Product $product)
    {
        // Authorization Check: Make sure the logged-in user owns this product
        if (Auth::user()->shop?->shop_id !== $product->shop_id) {
            abort(403, 'Unauthorized Action'); // Stop users from editing others' products
        }
        
        return response()->json([
            'product' => $product
        ], 201);
    }
}

   




    

