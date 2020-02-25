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
    Route::apiResource('user', 'AdminController')->only('index');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\Admin',
    'middleware' => ['auth.token']
], function () {
    Route::apiResource('subcategories', 'SubCategoryController');


    // Rutas del modulo de administradores
    Route::apiResource('administration', 'AdministratorController');


    // Rutas del Perfil del usuario con rol de staff
    Route::apiResource('perfil', 'PerfilController')->only('update', 'show');


    // Rutas del modulo de usuario
    Route::apiResource('clientes', 'CustomersController')->except('store');
    Route::get('/clientes/envio/all/{id}', 'ShippingController@index')->name('shippings.index');
    Route::apiResource('clientes/envio', 'ShippingController')->except('index');


    // Rutas del modulo de configuraciòn
    Route::apiResource('configurations', 'ConfigurationController')->except('store', 'destroy');
    Route::get('/configurations/slide/all/{id}', 'PhotoSlideController@index')->name('configurations.slide.index');
    Route::apiResource('configurations/slide', 'PhotoSlideController')->except('index');


    // Rutas del modulo de categorias
    Route::apiResource('categories', 'CategoryController');
    Route::get('/categories/slide/all/{id}', 'PhotoGalleryController@index')->name('categories.slide.index');
    Route::apiResource('categories/slide', 'PhotoGalleryController')->except('index');


    // Rutas del modulo de productos
    Route::apiResource('products', 'ProductController');
    Route::get('/products/photos/all/{id}', 'PhotoController@index')->name('photos.index');
    Route::apiResource('products/photos', 'PhotoController')->except('index');
    Route::apiResource('products/characteristics', 'CharacteristicController')->except('index');
    Route::get('/products/characteristics/all/{id}', 'CharacteristicController@index')->name('characteristics.index');
});
