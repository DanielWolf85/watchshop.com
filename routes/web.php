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

// Route::resource('rest', 'RestTestController')->names('restTest');




Route::group([
	'namespace' => 'Shop',
	'prefix'	=> 'shop'
], function () {
	Route::resource('products', 'ProductController')->names('shop.products');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// Админка блога

$groupData = [
	'namespace' => 'Shop\Admin',
	'prefix'	=> 'admin/shop',
];

Route::group($groupData, function() {
	// ShopCategory
	$methods = ['index', 'edit', 'update', 'create', 'store'];
	Route::resource('categories', 'CategoryController')
		->only($methods)
		->names('shop.admin.categories');
});


