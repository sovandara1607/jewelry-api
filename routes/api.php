<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\BackEndAPIController;
use App\Http\Controllers\FrontEndAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/testAPI', function () {
    return response()->json(
        [
            'server' => "API Server is working..."
        ],
        200
    );
});

//User Routes
Route::prefix('user')->group(function () {

    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('profile', [UserAuthController::class, 'profile']);
        Route::post('logout', [UserAuthController::class, 'logout']);
    });
});

//Admin Routes
Route::prefix('admin')->group(function () {

    Route::post('register', [AdminAuthController::class, 'register']);
    Route::post('login', [AdminAuthController::class, 'login']);


    Route::middleware('auth:admin_api')->group(function () {

        Route::get('dashboard', [AdminAuthController::class, 'dashboard']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
    });
});


//AdminController APIs (protected by admin auth)
Route::middleware('auth:admin_api')->group(function () {
    //http://127.0.0.1:8092/api/getAllProductList
    Route::get('/getAllProductList', [BackEndAPIController::class, 'getAllProductList']);
    //http://127.0.0.1:8092/api/productSearchList
    Route::get('/productSearchList', [BackEndAPIController::class, 'productSearchList']);
    //http://127.0.0.1:8092/api/filterProductList
    Route::get('/filterProductList', [BackEndAPIController::class, 'filterProductList']);

    //http://127.0.0.1:8092/api/getAllOrderList
    Route::get('/getAllOrderList', [BackEndAPIController::class, 'getAllOrderList']);
    //http://127.0.0.1:8092/api/orderSearchList
    Route::get('/orderSearchList', [BackEndAPIController::class, 'orderSearchList']);
    //http://127.0.0.1:8092/api/filterOrderList
    Route::get('/filterOrderList', [BackEndAPIController::class, 'filterOrderList']);
    //http://127.0.0.1:8092/api/ViewOrderItemsList
    Route::get('/ViewOrderItemsList', [BackEndAPIController::class, 'ViewOrderItemsList']);

    //http://127.0.0.1:8092/api/getAllShopList
    Route::get('/getAllShopList', [BackEndAPIController::class, 'getAllShopList']);
    //http://127.0.0.1:8092/api/shopSearchList
    Route::get('/shopSearchList', [BackEndAPIController::class, 'shopSearchList']);
    //http://127.0.0.1:8092/api/filterShopList
    Route::get('/filterShopList', [BackEndAPIController::class, 'filterShopList']);

    //http://127.0.0.1:8092/api/getAllUserList
    Route::get('/getAllUserList', [BackEndAPIController::class, 'getAllUserList']);
    //http://127.0.0.1:8092/api/userSearchList
    Route::get('/userSearchList', [BackEndAPIController::class, 'userSearchList']);
    //http://127.0.0.1:8092/api/filterUserList
    Route::get('/filterUserList', [BackEndAPIController::class, 'filterUserList']);
});


//----------------------------------------------------------------------


//FrontEndAPIController routes
// Cart
// GET http://127.0.0.1:8092/api/cart
Route::get('/cart', [FrontEndAPIController::class, 'Cartindex']);

// Public product routes
// GET http://127.0.0.1:8092/api/product/{product}
Route::get('/product/{product}', [FrontEndAPIController::class, 'showProduct']);

// Public: newest products for homepage
Route::get('/products/newest', [FrontEndAPIController::class, 'newestProducts']);
// Public: browse/search products
Route::get('/products/browse', [FrontEndAPIController::class, 'browseProducts']);
// Public: shop page
Route::get('/shops/{handle}/public', [FrontEndAPIController::class, 'shopPublic']);
// Public: get product for cart
Route::get('/products/{product}/detail', [FrontEndAPIController::class, 'getProductForCart']);

// Backend admin dashboard endpoints (protected by admin auth)
Route::middleware('auth:admin_api')->group(function () {
    Route::get('/dashboardStats', [BackEndAPIController::class, 'dashboardStats']);
    Route::get('/chartData', [BackEndAPIController::class, 'chartData']);
    Route::get('/ViewOrderItemsDetail', [BackEndAPIController::class, 'ViewOrderItemsDetail']);
});

// Frontend auth (no token required)
Route::post('/frontend/register', [FrontEndAPIController::class, 'registerUser']);
Route::post('/frontend/login', [FrontEndAPIController::class, 'loginUser']);

// Protected product routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // POST http://127.0.0.1:8092/api/product
    Route::post('/product', [FrontEndAPIController::class, 'storeProduct']);
    // GET http://127.0.0.1:8092/api/product/{product}/edit
    Route::get('/product/{product}/edit', [FrontEndAPIController::class, 'editProduct']);

    // Product CRUD
    Route::patch('/products/{product}', [FrontEndAPIController::class, 'updateProduct']);
    Route::delete('/products/{product}', [FrontEndAPIController::class, 'destroyProduct']);
    Route::post('/products/{product}/images', [FrontEndAPIController::class, 'addProductImages']);
    Route::delete('/products/{product}/images/{image}', [FrontEndAPIController::class, 'deleteProductImage']);

    // Shop CRUD
    Route::post('/shops', [FrontEndAPIController::class, 'createShop']);
    Route::get('/shops/my-dashboard', [FrontEndAPIController::class, 'shopDashboard']);
    Route::get('/shops/my-shop', [FrontEndAPIController::class, 'getUserShop']);
    Route::patch('/shops/{shop}', [FrontEndAPIController::class, 'updateShop']);
    Route::post('/shops/{shop}/picture', [FrontEndAPIController::class, 'updateShopPicture']);

    // Orders
    Route::post('/orders', [FrontEndAPIController::class, 'createOrder']);
    Route::post('/orders/accept/{orderItem}', [FrontEndAPIController::class, 'acceptOrder']);
    Route::post('/orders/reject/{orderItem}', [FrontEndAPIController::class, 'rejectOrder']);

    // User profile
    Route::get('/user/orders', [FrontEndAPIController::class, 'userOrders']);
    Route::post('/user/avatar', [FrontEndAPIController::class, 'updateAvatar']);
    Route::patch('/user/profile', [FrontEndAPIController::class, 'updateProfile']);
    Route::delete('/user/profile', [FrontEndAPIController::class, 'destroyProfile']);
    Route::post('/frontend/logout', [FrontEndAPIController::class, 'logoutUser']);
});
