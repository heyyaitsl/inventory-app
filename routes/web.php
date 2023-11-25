<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('home');


Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('warehouses', App\Http\Controllers\WarehouseController::class);
Route::resource('product-has-warehouses', App\Http\Controllers\ProductHasWarehouseController::class);

Route::delete('product-has-warehouses/{product_id}/{warehouse_id}', 'App\Http\Controllers\ProductHasWarehouseController@destroy')
    ->name('product-has-warehouses.destroy');
Route::get('product-has-warehouses/{product_id}/{warehouse_id}', 'App\Http\Controllers\ProductHasWarehouseController@show')
    ->name('product-has-warehouses.show');
Route::get('product-has-warehouses/{product_id}/{warehouse_id}', 'App\Http\Controllers\ProductHasWarehouseController@edit')
    ->name('product-has-warehouses.edit');
Route::patch('product-has-warehouses/{product_id}/{warehouse_id}', 'App\Http\Controllers\ProductHasWarehouseController@update')
    ->name('product-has-warehouses.update');
