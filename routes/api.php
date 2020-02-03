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
    Route::apiResources([
        'users' => 'UserController',
        'categories' => 'CategoryController',
        'subcategories' => 'SubCategoryController',
        'galleries' => 'GalleyController',
        'products' => 'ProductController'
    ]);

    Route::apiResource('configurations', 'ConfigurationController')->except('store', 'destroy');
    
    Route::apiResource('photoslide', 'PhotoSlideController')->except('index');
    Route::get('/photoslide/all/{id}', 'PhotoSlideController@index')->name('photoslide.index');

    Route::apiResource('photos', 'PhotoController')->except('index');
    Route::get('/photos/all/{id}', 'PhotoController@index')->name('photos.index');

    Route::apiResource('photosgalleries', 'PhotoGalleryController')->except('index');
    Route::get('/photosgalleries/all/{id}', 'PhotoGalleryController@index')->name('photosgalleries.index');

    Route::apiResource('characteristics', 'CharacteristicController')->except('index');
    Route::get('/characteristics/all/{id}', 'CharacteristicController@index')->name('characteristics.index');

    Route::apiResource('shippings', 'ShippingController')->except('index');
    Route::get('/shippings/all/{id}', 'ShippingController@index')->name('shippings.index');

    Route::put('/adminpassword/{id}', 'UserPasswordController@updateAdmin')->name('admins.password.update');
    Route::put('/userpassword/{id}', 'UserPasswordController@updateUser')->name('users.password.update');
});
