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

Route::get('/testAPI', function (){
    return response()->json(
        [
            'server'=>"API Server is working..."
        ],
        200
    );
});

//User Routes
Route::prefix('user')->group(function(){

    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function (){

        Route::get('profile', [UserAuthController::class, 'profile']);
        Route::post('logout', [UserAuthController::class, 'logout']);
    });
});

//Admin Routes
Route::prefix('admin')->group(function(){

    Route::post('register',[AdminAuthController::class, 'register']);
    Route::post('login',[AdminAuthController::class, 'login']);


    Route::middleware('auth::admin_api')->group(function(){

        Route::get('dashboard', [AdminAuthController::class, 'dashboard']);
        Route::post('logout',[AdminAuthController::class, 'logout']);
    });
});


//AdminController APIs
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


//----------------------------------------------------------------------


//FrontEndAPIController routes
//CartController
//http://127.0.0.1:8092/api/Cartindex
Route::get('/Cartindex', [FrontEndAPIController::class, 'Cartindex']);


//ProductController
//http://127.0.0.1:8092/api/showProduct
Route::get('/showProduct', [FrontEndAPIController::class, 'showProduct']);
//http://127.0.0.1:8092/api/storeProduct
Route::post('/storeProduct', [FrontEndAPIController::class, 'storeProduct']);
//http://127.0.0.1:8092/api/editProduct
Route::get('/editProduct', [FrontEndAPIController::class, 'editProduct']);
