<?php

use App\Http\Controllers\ItemController;
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
    return view('itmes.top');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('/use_user/{user}', 'HomeController@use_user')->name('use_user');
Route::get('/use_item/{item}', 'HomeController@use_item')->name('use_item');


Route::resource('items', 'ItemController');

Route::get('items/buy/{item}', [ItemController::class,'buy'])->name('items.buy');
Route::get('items/buy_confirm/{item}', [ItemController::class,'buy_confirm'])->name('items.buy_confirm');



