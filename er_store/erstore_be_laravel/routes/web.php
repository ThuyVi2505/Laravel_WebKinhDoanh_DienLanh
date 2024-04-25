<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

use App\http\Controllers\{BrandController,CategoryController, ProductController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::middleware(['PreventBackHistory'])->group(function () {
//     Auth::routes();
// });
Route::get('/', function () {
    return view('welcome');
});
Route::redirect('/','/admin');
Route::prefix('admin')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'login_form')->name('admin.login_form');
        Route::post('login', 'login_submit')->name('admin.login_submit');
        Route::middleware(['admin'])->group(function () {
            Route::get('/', 'index')->name('admin.dashboard');

            Route::get('logout', 'logout')->name('admin.logout');
        });
    });
    Route::middleware(['admin'])->group(function () {
        Route::controller(BrandController::class)->group(function () {
            Route::get('brand', 'index')->name('brand.index'); // index page
            Route::get('brand/{brand}/detail', 'show')->name('brand.detail'); // go to edit page

            Route::get('brand/create', 'create')->name('brand.create'); // go to create new page
            Route::post('brand/store', 'store')->name('brand.store'); // submit new create

            Route::get('brand/{brand}/edit', 'edit')->name('brand.edit'); // go to edit page
            Route::put('brand/{brand}', 'update')->name('brand.update'); // update new edit

            Route::post('brand/delete', 'delete')->name('brand.delete'); // delete
            Route::post('brand/changeStatus', 'changeStatus')->name('brand.changeStatus'); // change status
        });
        Route::controller(CategoryController::class)->group(function(){
            Route::get('category','index')->name('category.index');
            Route::get('category/{category}/detail', 'show')->name('category.detail'); // go to edit page

            
            Route::get('category/create', 'create')->name('category.create'); // go to create new page
            Route::post('category/store', 'store')->name('category.store'); // submit new create

            Route::get('category/{category}/edit', 'edit')->name('category.edit'); // go to edit page
            Route::put('category/{category}', 'update')->name('category.update'); // update new edit

            Route::post('category/delete', 'delete')->name('category.delete'); // delete
            Route::post('category/changeStatus', 'changeStatus')->name('category.changeStatus'); // change status

        });
        Route::controller(ProductController::class)->group(function () {
            Route::get('product','index')->name('product.index');
            Route::get('product/{product}/detail', 'show')->name('product.detail'); // go to edit page

            Route::get('product/create', 'create')->name('product.create'); // go to create new page
            Route::post('product/store', 'store')->name('product.store'); // submit new create

            Route::get('product/{product}/edit', 'edit')->name('product.edit'); // go to edit page
            Route::put('product/{product}', 'update')->name('product.update'); // update new edit

            Route::post('product/delete', 'delete')->name('product.delete'); // delete
            Route::post('product/changeStatus', 'changeStatus')->name('product.changeStatus'); // change status
        });
    });
});
