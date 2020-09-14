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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', "HomeController@index");
Route::get('/order/{order}/files/{file}/download', 'SharedController@download')->name('file.download');
Auth::routes();


Route::group(['prefix' => 'client', 'namespace' => 'Client', "middleware" => "auth"], function () {
    Route::get('/profile', 'DashboardController@index')->name('profile');
    Route::get('/payments', 'DashboardController@index')->name('payments');
    Route::get('/messages', 'DashboardController@index')->name('messages');
    Route::get('/reviews', 'DashboardController@index')->name('reviews');
    Route::get('/support', 'DashboardController@index')->name('support');
    //@@START@@ Client Order related routes
    Route::get('/dashboard', 'OrderController@index')->name('client.dashboard');
    Route::get('/order/create', 'OrderController@create')->name('client.orders.create');
    Route::post('{user}/order/new', 'OrderController@store')->name('client.orders.store');
    Route::get('order/{order}/edit', 'OrderController@edit')->name('client.order.edit');
    Route::patch('order/{order}/edit', 'OrderController@update')->name('client.order.update');
    Route::get('{user}/orders', 'OrderController@getOrders')->name('client.orders.show');
    Route::get('/orders/{order}', 'OrderController@show')->name('client.order.show');
    Route::delete('/orders/{order}', 'OrderController@destroy')->name('client.order.delete');

    Route::delete('/order/{order}/files/{file}/delete', 'OrderController@delete')->name('client.file.delete');
    Route::post('/order/{order}/files/additional', 'OrderController@additional')->name('client.file.additional');


    Route::post('/order/{order}/tutor/{user}/bid/{bid}', 'BidController@award')->name("client.order.award");
    //@@END@@ Client Order related routes

});


Route::group(['prefix' => 'tutor', 'namespace' => 'Tutor', "middleware" => "auth"], function () {

    //@@START@@  Tutor Order related routes
    Route::get('/dashboard', 'DashboardController@index')->name('tutor.dashboard');
    Route::get('/orders/available', 'OrderController@getOrders')->name("tutor.orders.browse");
    Route::get('/orders/view', 'OrderController@getOrders')->name("tutor.orders.show");
    Route::get('/orders/show/{order}', 'OrderController@show')->name("tutor.order.show");
    Route::get('{user}/my-orders/view', 'OrderController@myorders')->name("tutor.myorders.show");
    //@@START@@ Tutor Bids related routes
    Route::post('/bid/create/{order}/{user}', 'BidController@create')->name("tutor.bid.create");
    Route::delete('/bid/delete/{bid}/', 'BidController@destroy')->name("tutor.bid.delete");
    Route::get('/bid/show/{bid}/', 'BidController@show')->name("tutor.bid.show");
});
