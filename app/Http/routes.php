<?php

//Rutas de modelos

Route::bind('product', function($slug){
	return App\Models\Product::where('slug', $slug)->first();
});

Route::bind('category', function($category){
    return App\Models\Category::find($category);
});

Route::bind('user', function($user){
    return App\Models\User::find($user);
});

Route::bind('photogallery', function($gallery){
    return App\Models\PhotosGallery::find($gallery);
});


//rutas publicas

Route::get('/', 'Store\StoreController@index')->name('home');

Route::get('product/{slug}', 'Store\StoreController@show')->name('product-detail');

Route::get('category/{category_id}', 'Store\CategoriesController@index')->name('category-product');

// Carrito 

Route::get('cart/show', 'Store\CartController@show')->name('cart-show');

Route::get('cart/add/{product}', 'Store\CartController@add')->name('cart-add');

Route::get('cart/delete/{product}', 'Store\CartController@delete')->name('cart-delete');

Route::get('cart/trash', 'Store\CartController@trash')->name('cart-trash');

Route::get('cart/update/{product}/{quantity}', 'Store\CartController@update')->name('cart-update');

Route::get('order-detail', [
	'middleware' => 'auth:user',
	'as' => 'order-detail',
	'uses' => 'Store\CartController@orderDetail'
]);


// Authentication routes

Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login-get');

Route::post('auth/login', 'Auth\AuthController@postLogin')->name('login-post');

Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');


// Registration routes

Route::get('auth/register', 'Auth\AuthController@getRegister')->name('register-get');

Route::post('auth/register', 'Auth\AuthController@postRegister')->name('register-post');


// Enviamos nuestro pedido a PayPal

Route::get('payment', 'Store\PaypalController@postPayment')->name('payment');


// Después de realizar el pago Paypal redirecciona a esta ruta

Route::get('payment/status', 'Store\PaypalController@getPaymentStatus')->name('payment.status');


// ADMIN -------------

Route::group(['namespace' => 'Admin', 'middleware' => ['auth'], 'prefix' => 'admin'], function()
{
	Route::get('home', function(){
		return view('admin.home');
	});

	Route::resource('category', 'CategoryController');

	Route::resource('photogallery', 'PhotoGalleryController');

	Route::resource('product', 'ProductController');

	Route::resource('user', 'UserController', ['except' => [
		'show'
	]]);

	Route::resource('password', 'UserPasswordController', ['only' => [
		'edit', 'update'
	]]);


	// Caracteristicas del producto

	Route::resource('characteristics', 'CharastecController', ['except' => [
		'create', 'index'
	]]);

	Route::get('characteristics/create/{id}', 'CharastecController@create')->name('admin.characteristics.create');


	// Direcciones de envio para el usuario

	Route::resource('envios', 'UserEnvioController', ['except' => [
		'create', 'index'
	]]);

	Route::get('envios/create/{user_id}', 'UserEnvioController@create')->name('admin.envios.create');


	//Rutas de la orden

	Route::get('orders', 'OrderController@index')->name('admin.order.index');

	Route::get('order/get-items', 'OrderController@getItems')->name('admin.order.getItems');

	Route::get('order/{id}', 'OrderController@destroy')->name('admin.order.destroy');

});