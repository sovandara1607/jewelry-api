<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminShopController;
use App\Http\Controllers\AdminUserController;

//All BackEnd Routes--
//127.0.0.1:8000/AdminLogin
Route::get('/AdminLogin', [LoginController::class, 'AdminLoginForm'])->name('adminlogin');
Route::post('/ProcessAdminLogin', [LoginController::class,'Admin_login'])->name('adminlogin');


//127.0.0.1:8000/Dashboard
Route::get('/Dashboard',[AdminProductController::class, 'Dashboard'] );

//127.0.0.1:8000/ProductManagement
Route::get('/ProductManagement',[AdminProductController::class, 'AllProducts'] );

//127.0.0.1:8000/OrderManagement
Route::get('/OrderManagement',[AdminOrderController::class, 'AllOrders'] );

//127.0.0.1:8000/UserManagement
Route::get('/UserManagement',[AdminUserController::class, 'AllUsers'] );

//127.0.0.1:8000/ShopManagement
Route::get('/ShopManagement',[AdminShopController::class, 'AllShops'] );

// http://127.0.0.1:8090//product/{oID}
Route::get('/productOrder/{oID}',[AdminOrderController::class,'ViewOrderItems'] );



//All BACKEND SEARCH FUNCTIONS
Route::get('/searchProduct', [AdminProductController::class, 'search'])->name('product.search');
Route::get('/searchUser', [AdminUserController::class, 'search'])->name('user.search');
Route::get('/searchShop', [AdminShopController::class, 'search'])->name('shop.search');

//ProductManagement
// http://127.0.0.1:8000/BroochCategory
Route::get('/BraceletCategory',[AdminProductController::class,'filter_Bracelet'] );
// http://127.0.0.1:8000/BroochCategory
Route::get('/BroochCategory',[AdminProductController::class,'filter_Brooch'] );
// http://127.0.0.1:8000/EarringCategory
Route::get('/EarringCategory',[AdminProductController::class,'filter_Earring'] );
// http://127.0.0.1:8000/NecklaceCategory
Route::get('/NecklaceCategory',[AdminProductController::class,'filter_Necklace'] );
// http://127.0.0.1:8000/RingCategory
Route::get('/RingCategory',[AdminProductController::class,'filter_Ring'] );

Route::get('/clickButtonOne', [AdminProductController::class, 'buttonOne'])->name('product.PageOne');
Route::get('/clickButtonNext', [AdminProductController::class, 'buttonNext'])->name('product.PageNext');
Route::get('/clickButtonBack', [AdminProductController::class, 'buttonNext'])->name('product.PageBack');

//UserManagement
// http://127.0.0.1:8000/A_alphabetUser
Route::get('/A_alphabetUser',[AdminUserController::class,'filter_A'] );
// http://127.0.0.1:8000/B_alphabetUser
Route::get('/B_alphabetUser',[AdminUserController::class,'filter_B'] );
// http://127.0.0.1:8000/C_alphabetUser
Route::get('/C_alphabetUser',[AdminUserController::class,'filter_C'] );
// http://127.0.0.1:8000/D_alphabetUser
Route::get('/D_alphabetUser',[AdminUserController::class,'filter_D'] );
// http://127.0.0.1:8000/E_alphabetUser
Route::get('/E_alphabetUser',[AdminUserController::class,'filter_E'] );
// http://127.0.0.1:8000/F_alphabetUser
Route::get('/F_alphabetUser',[AdminUserController::class,'filter_F'] );
// http://127.0.0.1:8000/G_alphabetUser
Route::get('/G_alphabetUser',[AdminUserController::class,'filter_G'] );
