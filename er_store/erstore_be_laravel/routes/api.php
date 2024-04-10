<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{BrandController, CategoryController, ProductController, ImageController};
use App\Http\Controllers\API\{AuthController,UserController};

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
/*AUTH*/
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//user
Route::get('/profile_user_logged', [UserController::class, 'getUserLogged'])->middleware('auth:sanctum');
Route::post('/change_password', [UserController::class, 'changePassword'])->middleware('auth:sanctum');
Route::put('/update_profile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum');

/*BRAND*/
Route::get('/brands', [BrandController::class, 'getAll']); // GET all
Route::get('/brands/{id}', [BrandController::class, 'getById']); // GET by Id
Route::post('/brands', [BrandController::class, 'store']); //POST - CREATE NEW
Route::match(['put', 'patch'], '/brands/{id}', [BrandController::class, 'update']); // POST - update (method: PUT or PATCH)
Route::DELETE('/brands/{id}', [BrandController::class, 'destroy']); //POST - Delete (method: DELETE)

/*CATEGORY*/
Route::get('/categories', [CategoryController::class, 'getAll']);
Route::get('categories/{id}', [CategoryController::class, 'getById']);
Route::post('/categories', [CategoryController::class, 'store']);
/*PRODUCT - IMAGE - Attribute (-> value)*/
Route::get('/products', [ProductController::class, 'getAll']);
Route::get('/products/{id}', [ProductController::class, 'getById']);
Route::post('/products', [ProductController::class, 'store']);
//image
Route::post('/products/upload/{id}', [ImageController::class, 'uploadImage_Product']);
//attribute -> value