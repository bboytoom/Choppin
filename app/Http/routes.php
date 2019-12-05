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

Route::get('/', [
	'as' => 'home',
	'uses' => 'Store\StoreController@index'
]);

Route::get('product/{slug}', [
	'as' => 'product-detail',
	'uses' => 'Store\StoreController@show'
]);

Route::get('category/{category_id}', [
	'as' => 'category-product',
	'uses' => 'Store\CategoriesController@index'
]);

// Carrito 

Route::get('cart/show', [
	'as' => 'cart-show',
	'uses' => 'Store\CartController@show'
]);

Route::get('cart/add/{product}', [
	'as' => 'cart-add',
	'uses' => 'Store\CartController@add'
]);

Route::get('cart/delete/{product}',[
	'as' => 'cart-delete',
	'uses' => 'Store\CartController@delete'
]);

Route::get('cart/trash', [
	'as' => 'cart-trash',
	'uses' => 'Store\CartController@trash'
]);

Route::get('cart/update/{product}/{quantity}', [
	'as' => 'cart-update',
	'uses' => 'Store\CartController@update'
]);

Route::get('order-detail', [
	'middleware' => 'auth:user',
	'as' => 'order-detail',
	'uses' => 'Store\CartController@orderDetail'
]);


// Authentication routes

Route::get('auth/login', [
	'as' => 'login-get',
	'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('auth/login', [
	'as' => 'login-post',
	'uses' => 'Auth\AuthController@postLogin'
]);

Route::get('auth/logout', [
	'as' => 'logout',
	'uses' => 'Auth\AuthController@getLogout'
]);


// Registration routes

Route::get('auth/register', [
	'as' => 'register-get',
	'uses' => 'Auth\AuthController@getRegister'
]);

Route::post('auth/register', [
	'as' => 'register-post',
	'uses' => 'Auth\AuthController@postRegister'
]);


// Enviamos nuestro pedido a PayPal

Route::get('payment', array(
	'as' => 'payment',
	'uses' => 'Store\PaypalController@postPayment',
));


// Después de realizar el pago Paypal redirecciona a esta ruta

Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'Store\PaypalController@getPaymentStatus',
));


// ADMIN -------------

Route::group(['namespace' => 'Admin', 'middleware' => ['auth'], 'prefix' => 'admin'], function()
{
	Route::get('home', function(){
		return view('admin.home');
	});

	Route::resource('category', 'CategoryController');

	Route::resource('photogallery', 'PhotoGalleryController');

	Route::resource('product', 'ProductController');

	Route::resource('user', 'UserController', ['except' => ['show']]);

	Route::resource('password', 'UserPasswordController', ['only' => ['edit', 'update']]);


	// Caracteristicas del producto

	Route::resource('characteristics', 'CharastecController', ['except' => ['create', 'index']]);

	Route::get('characteristics/create/{id}', [
	    'as' => 'admin.characteristics.create',
	    'uses' => 'CharastecController@create'
	]);


	// Direcciones de envio para el usuario

	Route::resource('envios', 'UserEnvioController', ['except' => ['create', 'index']]);

	Route::get('envios/create/{user_id}', [
	    'as' => 'admin.envios.create',
	    'uses' => 'UserEnvioController@create'
	]);


	//Rutas de la orden

	Route::get('orders', [
		'as' => 'admin.order.index',
		'uses' => 'OrderController@index'
	]);

	Route::post('order/get-items', [
	    'as' => 'admin.order.getItems',
	    'uses' => 'OrderController@getItems'
	]);

	Route::get('order/{id}', [
	    'as' => 'admin.order.destroy',
	    'uses' => 'OrderController@destroy'
	]);
});