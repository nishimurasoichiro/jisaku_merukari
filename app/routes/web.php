<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
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
    return redirect('items'); 
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('/use_user/{user}', 'HomeController@use_user')->name('use_user');
Route::get('/use_item/{item}', 'HomeController@use_item')->name('use_item');


Route::resource('items', 'ItemController');

Route::get('items/buy/{item}', [ItemController::class,'buy'])->name('items.buy');
Route::get('items/buy_confirm/{item}', [ItemController::class,'buy_confirm'])->name('items.buy_confirm');

//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    //「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
    Route::post('ajaxlike', 'ItemController@ajaxlike')->name('items.ajaxlike');
});

Route::post('user_edit', [HomeController::class,'update_userForm'])->name('user_edit');
Route::post('update_edit/{user_id}', [HomeController::class,'update_user'])->name('update_user');

Route::get('stop_user', 'HomeController@stop_user')->name('stop_user');