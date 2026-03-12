<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\OrderItem;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:100',
            'product_category' => 'required|string|max:50',
            'product_price' => 'required|numeric|min:0',
            'product_description' => 'nullable|string',
            'product_images' => 'nullable|array',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'image_paths' => 'nullable|array',
            'image_paths.*' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validatedData = $validator->validated();
        $product = Product::create([
            'shop_id' => Auth::user()->shop->shop_id,
            'product_name' => $validatedData['product_name'],
            'product_category' => $validatedData['product_category'],
            'product_price' => $validatedData['product_price'],
            'product_description' => $validatedData['product_description'] ?? null,
            'in_stock' => 1,
        ]);
        // Accept either file uploads or path strings
        if ($request->has('image_paths')) {
            foreach ($request->image_paths as $path) {
                $product->images()->create(['image_path' => $path]);
            }
        } elseif ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $path = $file->store('product-images', 'public');
                $product->images()->create(['image_path' => $path]);
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
        ], 200);
    }

    // ---- NEW ENDPOINTS ----

    // Newest products for homepage
    public function newestProducts(Request $request)
    {
        $query = Product::query();
        if ($request->has('exclude_shop')) {
            $query->where('shop_id', '!=', $request->exclude_shop);
        }
        $products = $query->where('in_stock', '>', 0)
            ->with('images')->latest('date_created')->take(4)->get();

        return response()->json(['products' => $products], 200);
    }

    // Browse/search products for shop page
    public function browseProducts(Request $request)
    {
        $query = Product::query();
        $query->join('shop', 'product.shop_id', '=', 'shop.shop_id');
        $query->select('product.*');

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('product.product_name', 'like', $searchTerm)
                    ->orWhere('product.product_description', 'like', $searchTerm)
                    ->orWhere('product.product_category', 'like', $searchTerm)
                    ->orWhere('shop.shop_name', 'like', $searchTerm);
            });
        }

        if ($request->has('exclude_shop')) {
            $query->where('product.shop_id', '!=', $request->exclude_shop);
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('product.product_category', $request->category);
        }

        $query->orderBy('in_stock', 'desc');
        if ($request->get('sort') === 'price_asc') {
            $query->orderBy('product.product_price', 'asc');
        } elseif ($request->get('sort') === 'price_desc') {
            $query->orderBy('product.product_price', 'desc');
        } else {
            $query->orderBy('product.date_created', 'desc');
        }

        $query->with('images', 'shop');
        $products = $query->get();

        return response()->json(['products' => $products], 200);
    }

    // Update product
    public function updateProduct(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:100',
            'product_category' => 'required|string|max:50',
            'product_price' => 'required|numeric|min:0',
            'product_description' => 'nullable|string',
            'product_images' => 'nullable|array',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update product basic info
        $product->update($validator->safe()->only([
            'product_name',
            'product_category',
            'product_price',
            'product_description'
        ]));

        // Handle new image uploads
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $path = $file->store('product-images', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        $product->load('images');
        return response()->json(['message' => 'Product updated.', 'product' => $product], 200);
    }

    // Delete product
    public function destroyProduct(Product $product)
    {
        DB::transaction(function () use ($product) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }
            $product->delete();
        });
        return response()->json(['message' => 'Product deleted.'], 200);
    }

    // Add images to product
    public function addProductImages(Request $request, Product $product)
    {
        $paths = [];
        // Accept either file uploads or path strings
        if ($request->has('image_paths')) {
            foreach ($request->image_paths as $path) {
                $product->images()->create(['image_path' => $path]);
                $paths[] = $path;
            }
        } else {
            $request->validate(['product_images' => 'required|array', 'product_images.*' => 'image|max:10240']);
            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $file) {
                    $path = $file->store('product-images', 'public');
                    $product->images()->create(['image_path' => $path]);
                    $paths[] = $path;
                }
            }
        }
        return response()->json(['message' => 'Images added.', 'paths' => $paths], 201);
    }

    // Delete product image
    public function deleteProductImage(Product $product, ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return response()->json(['message' => 'Image deleted.'], 200);
    }

    // ---- Shop Endpoints ----

    public function createShop(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shop_name' => 'required|string|max:100|unique:shop,shop_name',
            'shop_email' => 'required|email|max:100',
            'shop_phonenumber' => 'required|string|max:20',
            'shop_address' => 'required|string|max:255',
            'shop_description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        $data['user_id'] = Auth::id();
        $shop = Shop::create($data);
        return response()->json(['message' => 'Shop created.', 'shop' => $shop], 201);
    }

    public function updateShop(Request $request, Shop $shop)
    {
        $validator = Validator::make($request->all(), [
            'shop_name' => 'required|string|max:100|unique:shop,shop_name,' . $shop->shop_id . ',shop_id',
            'shop_email' => 'required|email|max:100',
            'shop_phonenumber' => 'required|string|max:20',
            'shop_address' => 'required|string|max:255',
            'shop_description' => 'nullable|string',
            'shop_profilepic' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $shop->update($validator->validated());
        return response()->json(['message' => 'Shop updated.', 'shop' => $shop], 200);
    }

    public function updateShopPicture(Request $request, Shop $shop)
    {
        // Accept either a file upload or a path string
        if ($request->has('shop_profilepic_path')) {
            $path = $request->shop_profilepic_path;
        } else {
            $request->validate(['shop_profilepic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
            if ($shop->shop_profilepic) {
                Storage::disk('public')->delete($shop->shop_profilepic);
            }
            $path = $request->file('shop_profilepic')->store('shop-pictures', 'public');
        }
        $shop->update(['shop_profilepic' => $path]);
        return response()->json(['message' => 'Shop picture updated.', 'path' => $path], 200);
    }

    public function shopPublic($handle)
    {
        $shop = Shop::where('shop_name', $handle)->firstOrFail();
        $products = $shop->products()->with('images')
            ->orderBy('in_stock', 'desc')->latest('date_created')->get();
        return response()->json(['shop' => $shop, 'products' => $products], 200);
    }

    public function shopDashboard(Request $request)
    {
        $user = $request->user();
        $shop = Shop::where('user_id', $user->id)->first();
        if (!$shop) {
            return response()->json(['shop' => null], 200);
        }
        $productIds = $shop->products()->pluck('product_id');
        $activeListings = $shop->products()->where('in_stock', '>', 0)
            ->with('images')->latest('date_created')->get();
        $pendingOrders = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', fn($q) => $q->where('status', 'Pending'))
            ->with(['product.images', 'order.user'])->latest('date_created')->get();
        $confirmedOrders = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', fn($q) => $q->where('status', 'Confirmed'))
            ->with(['product.images', 'order.user'])->latest('date_created')->get();

        return response()->json([
            'shop' => $shop,
            'listings' => $activeListings,
            'pendingOrders' => $pendingOrders,
            'confirmedOrders' => $confirmedOrders,
        ], 200);
    }

    // ---- Order Endpoints ----

    public function createOrder(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|numeric|min:0.01',
            'cart' => 'required|array',
            'delivery_address' => 'required|string',
        ]);

        $cart = $request->cart;
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_date' => now(),
                'total_amount' => $request->total_amount,
                'status' => 'Pending',
                'delivery_address' => $request->delivery_address,
            ]);
            foreach ($cart as $productId => $details) {
                $product = Product::find($productId);
                if (!$product) throw new \Exception("Product with ID {$productId} not found.");
                if ($product->in_stock == 0) throw new \Exception("Product '{$product->product_name}' is no longer in stock.");
                $order->items()->create([
                    'order_id' => $order->order_id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'price' => $details['price'],
                ]);
                $product->in_stock = 0;
                $product->save();
            }
            DB::commit();
            return response()->json(['message' => 'Order placed.', 'order' => $order], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Order failed: ' . $e->getMessage()], 500);
        }
    }

    public function acceptOrder(OrderItem $orderItem)
    {
        DB::transaction(function () use ($orderItem) {
            $orderItem->order->update(['status' => 'Confirmed']);
            $orderItem->product->update(['in_stock' => 0]);
        });
        return response()->json(['message' => 'Order confirmed.'], 200);
    }

    public function rejectOrder(OrderItem $orderItem)
    {
        DB::transaction(function () use ($orderItem) {
            $orderItem->order->update(['status' => 'Rejected']);
            $orderItem->product->update(['in_stock' => 1]);
        });
        return response()->json(['message' => 'Order rejected.'], 200);
    }

    // ---- User Profile Endpoints ----

    public function userOrders(Request $request)
    {
        $user = $request->user();
        $pendingOrders = $user->orders()->where('status', 'Pending')
            ->with('items.product.images')->get();
        $confirmedOrders = $user->orders()->where('status', 'Confirmed')
            ->with('items.product.shop')->get();
        $orders = $user->orders()->latest()->get();

        return response()->json([
            'orders' => $orders,
            'pendingOrders' => $pendingOrders,
            'confirmedOrders' => $confirmedOrders,
        ], 200);
    }

    public function updateAvatar(Request $request)
    {
        $user = $request->user();
        // Accept either a file upload or a path string
        if ($request->has('profilepic_path')) {
            $path = $request->profilepic_path;
        } else {
            $request->validate(['profilepic' => 'required|image|max:2048']);
            if ($user->profilepic) {
                Storage::disk('public')->delete($user->profilepic);
            }
            $path = $request->file('profilepic')->store('avatars', 'public');
        }
        $user->profilepic = $path;
        $user->save();
        return response()->json(['message' => 'Avatar updated.', 'path' => $path], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phonenumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user->fill($validator->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();
        return response()->json(['message' => 'Profile updated.', 'user' => $user], 200);
    }

    public function destroyProfile(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $user->delete();
        return response()->json(['message' => 'Account deleted.'], 200);
    }

    // Get user's shop info
    public function getUserShop(Request $request)
    {
        $user = $request->user();
        $shop = Shop::where('user_id', $user->id)->first();
        return response()->json(['shop' => $shop], 200);
    }

    // Get product details for cart add
    public function getProductForCart(Product $product)
    {
        $product->load('images', 'shop');
        return response()->json(['product' => $product], 200);
    }

    // Register user (for frontend Breeze replacement)
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phonenumber' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
        ]);
        $token = $user->createToken('remember_token')->plainTextToken;
        return response()->json([
            'message' => 'User registered.',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Login user (for frontend Breeze replacement)
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $user->createToken('remember_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    // Logout user
    public function logoutUser(Request $request)
    {
        $user = $request->user();
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }
        return response()->json(['message' => 'Logged out.'], 200);
    }

    // Debug upload functionality
    public function debugUpload(Request $request)
    {
        $debugInfo = [
            'has_files' => $request->hasFile('product_images'),
            'files_count' => $request->hasFile('product_images') ? count($request->file('product_images')) : 0,
            'all_input' => $request->all(),
            'file_info' => [],
            'storage_config' => config('filesystems.disks.public'),
            'storage_path' => storage_path('app/public'),
            'storage_exists' => is_dir(storage_path('app/public')),
            'storage_writable' => is_writable(storage_path('app/public')),
        ];

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $key => $file) {
                $debugInfo['file_info'][$key] = [
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'is_valid' => $file->isValid(),
                    'error' => $file->getError(),
                ];
            }

            // Try to store one file for testing
            try {
                $file = $request->file('product_images')[0];
                $path = $file->store('product-images', 'public');
                $debugInfo['test_upload'] = [
                    'success' => true,
                    'path' => $path,
                    'full_path' => storage_path('app/public/' . $path),
                    'file_exists' => Storage::disk('public')->exists($path),
                ];
            } catch (\Exception $e) {
                $debugInfo['test_upload'] = [
                    'success' => false,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return response()->json($debugInfo);
    }
}