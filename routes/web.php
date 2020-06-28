<?php

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
Route::get('show','AdminController@index')->name('dashboard');
Auth::routes();
Route::group(['as'=>'cart.','prefix'=>'cart'], function ()
{
Route::get('/','AdminController@cart')->name('cart');
Route::get('/{product}','AdminController@removeProduct')->name('remove');
Route::post('/{product}','AdminController@updateProduct')->name('update');
Route::get('addToCart/{product}','AdminController@addToCart')->name('add');
});
route::group(['as'=>'checkout.','prefix'=>'checkout'],function()
{
Route::get('/','OrderController@addToCheckout')->name('checkout');
Route::post('addToCheckout/','OrderController@store')->name('checkout1');
});

Route::get('product','ProductController@index');
Route::get('categories','CategoriesController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('add_categories','CategoriesController@store')->name('add_cat');
Route::get('get_categories','CategoriesController@create')->name('get_cat');
Route::get('edit_categories{id}','CategoriesController@edit')->name('edit');
Route::PUT('update_categories{id}','CategoriesController@update');
Route::DELETE('delete_categories{id}','CategoriesController@destroy')->name('delete_cat');
Route::get('trash_categories{id}','CategoriesController@trash');
Route::get('show_trash','CategoriesController@show_trash')->name('show');
Route::get('recover_trash{id}','CategoriesController@recover_trash');
Route::get('edit_product{id}','ProductController@edit');
Route::post('add_product','ProductController@store')->name('add_pro');
Route::get('show_product','ProductController@show')->name('show_pro');
Route::PUT('update_product{id}','ProductController@update');
Route::DELETE('delete_product{id}','ProductController@destroy')->name('delete_pro');
Route::get('users_add','ProfileController@index')->name('users');
Route::post('add_user','ProfileController@store')->name('add_user');
Route::get('show_users','ProfileController@show')->name('show_users');
Route::get('edit_profile{id}','ProfileController@edit');
Route::PUT('update_users{id}','ProfileController@update');
Route::DELETE('delete_profile{id}','ProfileController@destroy')->name('delete');
Route::get('frontend','AdminController@show')->name('frontend');
Route::get('/{product}','AdminController@single')->name('single');
Route::post('order','OrderController@store');

