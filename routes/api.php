<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| API\Store: Rutas publicas 
| 
| API\User: Rutas perteneciente al administrador del usuario
|
| API\Admin: Rutas de la administracion de la tienda
|
*/

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\Store',
    'middleware' => ['authheader']
], function () {
    Route::apiResource('store', 'IndexController')->except('update', 'destroy');
    Route::post('checkauth', 'AuthUserController@logIn');
    Route::post('logout', 'AuthUserController@logOut');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\User',
    'middleware' => ['auth.token']
], function () {
    Route::apiResource('user', 'AdminController')->only('index');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\Admin',
    'middleware' => ['auth.token']
], function () {
    Route::apiResource('subcategories', 'SubCategoryController');

    // Rutas del modulo de configuraciòn
    Route::apiResource('configurations', 'ConfigurationController')->except('store', 'destroy');
    Route::get('/configurations/slide/all/{id}', 'PhotoSlideController@index')->name('configurations.slide.index');
    Route::apiResource('configurations/slide', 'PhotoSlideController')->except('index');


    // Rutas del modulo de categorias
    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('categories/galleries', 'GalleyController');
    Route::get('/galleries/slide/all/{id}', 'PhotoGalleryController@index')->name('galleries.slide.index');
    Route::apiResource('galleries/slide', 'PhotoGalleryController')->except('index');


    // Rutas del modulo de productos
    Route::apiResource('products', 'ProductController');
    Route::get('/products/photos/all/{id}', 'PhotoController@index')->name('photos.index');
    Route::apiResource('products/photos', 'PhotoController')->except('index');
    Route::apiResource('products/characteristics', 'CharacteristicController')->except('index');
    Route::get('/products/characteristics/all/{id}', 'CharacteristicController@index')->name('characteristics.index');


    // Rutas del modulo de usuario
    Route::apiResource('users', 'UserController');
    Route::get('/users/shippings/all/{id}', 'ShippingController@index')->name('shippings.index');
    Route::apiResource('users/shippings', 'ShippingController')->except('index');
    Route::put('/users/password/{id}', 'UserPasswordController@updateUser')->name('users.password.update');
});
