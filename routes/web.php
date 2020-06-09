<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', 'ShowController@index')->name('index');
Route::get('/details/{id}', 'ShowController@show')->name('products.show');
//Route ::group(['middleware' => ['auth']],function(){});
Route::post('/panier/ajouter', 'CartController@store')->name('cart.store');
Route::get('/panier','CartController@index')->name('cart.index');
Route::patch('/panier/{rowId}','CartController@update')->name('cart.update');
Route::delete('/panier/{rowId}','CartController@destroy')->name('cart.destroy');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/paiement', 'CheckoutController@index')->name('checkout.index');
Route::post('/paiement', 'CheckoutController@store')->name('checkout.store');
Route::get('/merci','CheckoutController@merci')->name('checkout.merci');

Route::get('/myorders','OrdersDisplaying@index')->name('checkout.orders');
//managing comments
Route::post('/comments/{id}','Comment@store')->name('comments');

