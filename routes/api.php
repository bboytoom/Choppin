<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| API\Store: Sección pública
|
| API\User: Administrador del usuario
|
| API\Admin: Administrador principal
|
*/

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\Store',
    'middleware' => ['authheader']
], function () {
    Route::apiResource('store', 'IndexController')->except('update', 'destroy');

    Route::post('login', 'AuthUserController@logIn');
    Route::post('logout', 'AuthUserController@logOut');
    Route::post('myuser', 'AuthUserController@getUser');
    Route::post('refresh', 'AuthUserController@refreshToken');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\User',
    'middleware' => ['auth.token']
], function () {
    Route::apiResource('user', 'AdminController')->only('index', 'store');
    Route::apiResource('user/order', 'OrderController')->only('index', 'show');
});

Route::get('/v1/user/payment', 'API\User\AdminController@buy')->name('user.payment');

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\Admin',
    'middleware' => ['auth.token']
], function () {
    Route::apiResource('permissions', 'PermissionController');

    Route::apiResource('administration', 'AdministratorController');

    Route::apiResource('perfil', 'PerfilController')->only('update', 'show');

    Route::apiResource('clientes', 'CustomersController')->except('store');
    Route::get('/clientes/envio/all/{id}', 'ShippingController@index')->name('shippings.index');
    Route::apiResource('clientes/envio', 'ShippingController')->except('index');

    Route::apiResource('configurations', 'ConfigurationController')->except('store', 'destroy');
    Route::get('/configurations/slide/all/{id}', 'PhotoSlideController@index')->name('configurations.slide.index');
    Route::apiResource('configurations/slide', 'PhotoSlideController')->except('index');
    Route::get('/configurations/meta/all/{id}', 'MetaController@index')->name('configurations.meta.index');
    Route::apiResource('configurations/meta', 'MetaController')->only('update', 'show');

    Route::apiResource('categories', 'CategoryController');

    Route::apiResource('subcategories', 'SubCategoryController');

    Route::apiResource('products', 'ProductController');
    Route::get('/products/photos/all/{id}', 'PhotoController@index')->name('photos.index');
    Route::apiResource('products/photos', 'PhotoController')->except('index');
    Route::apiResource('products/characteristics', 'CharacteristicController')->except('index');
    Route::get('/products/characteristics/all/{id}', 'CharacteristicController@index')->name('characteristics.index');

    Route::apiResource('order', 'OrderController')->except('store', 'destroy');

    Route::apiResource('coupon', 'CouponController');
});
