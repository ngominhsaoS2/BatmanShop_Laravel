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

Route::get('Home', [
	'as' => 'Home',
	'uses' => 'PageController@getHome',
]);

Route::get('ProductCategory/{id}', [
	'as' => 'ProductCategory',
	'uses' => 'PageController@getProductCategory',
]);

Route::get('Product/{id}', [
	'as' => 'Product',
	'uses' => 'PageController@getProduct',
]);

Route::get('Contact', [
	'as' => 'Contact',
	'uses' => 'PageController@getContact',
]);

Route::get('AddToCart/{id}', [
	'as' => 'AddToCart',
	'uses' => 'PageController@getAddToCart',
]);

Route::get('DeleteCartItem/{id}', [
	'as' => 'DeleteCartItem',
	'uses' => 'PageController@getDeleteCartItem',
]);

Route::get('Order', [
	'as' => 'Order',
	'uses' => 'PageController@getOrder',
]);

Route::post('Order', [
	'as' => 'Order',
	'uses' => 'PageController@postOrder',
]);

Route::get('Login', [
	'as' => 'Login',
	'uses' => 'PageController@getLogin',
]);

Route::post('Login', [
	'as' => 'Login',
	'uses' => 'PageController@postLogin',
]);

Route::get('Logout', [
	'as' => 'Logout',
	'uses' => 'PageController@getLogout',
]);

Route::get('SignUp', [
	'as' => 'SignUp',
	'uses' => 'PageController@getSignUp',
]);

Route::post('SignUp', [
	'as' => 'SignUp',
	'uses' => 'PageController@postSignUp',
]);

Route::get('Search', [
	'as' => 'Search',
	'uses' => 'PageController@getSearch',
]);
