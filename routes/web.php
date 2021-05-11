<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', 'HomeController@index');
Route::get('profile', 'ProfileController@edit')->name('profile.edit');
Route::put('profile', 'ProfileController@update')->name('profile.update');

Route::resource('products.cart', 'ProductCartController')->only(['store', 'destroy']);
Route::resource('orders.payments', 'OrderPaymentController')->middleware(['verified'])->only(['store', 'create']);
Route::resource('cart', 'CartController')->only(['index']);
Route::resource('orders', 'OrderController')->middleware(['verified'])->only(['create', 'store']);

// Route::get('products', 'ProductController@index')->name('products.index');
// Route::get('products/create', 'ProductController@create')->name('products.create');
// Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit');
// Route::post('products/store', 'ProductController@store')->name('products.store');
// Route::put('products/{product}', 'ProductController@update')->name('products.update');
// Route::get('products/{product}', 'ProductController@show')->name('products.show');
// Route::delete('products/{product}', 'ProductController@destroy')->name('products.delete');

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
