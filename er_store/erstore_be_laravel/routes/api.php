<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{BrandController, CategoryController, ProductController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/brands', [BrandController::class, 'getAll']); // GET all
Route::get('/brands/{id}', [BrandController::class, 'getById']); // GET by Id
Route::post('/brands', [BrandController::class, 'store']); //POST - CREATE NEW
Route::match(['put', 'patch'], '/brands/{id}', [BrandController::class, 'update']); // POST - update (method: PUT or PATCH)
Route::DELETE('/brands/{id}', [BrandController::class, 'destroy']); //POST - Delete (method: DELETE)


Route::get('/categories', [CategoryController::class, 'getAll']);
Route::get('categories/{id}', [CategoryController::class, 'getById']);
Route::post('/categories', [CategoryController::class, 'store']);

Route::get('/products', [ProductController::class, 'getAll']);
Route::get('/products/{id}', [ProductController::class, 'getById']);
Route::post('/products', [ProductController::class, 'store']);