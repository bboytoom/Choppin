<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\Store',
    'middleware' => ['authheader']
], function () {
    Route::apiResource('store', 'IndexController')->except('update', 'destroy');
    Route::post('checkauthuser', 'AuthUserController@logIn');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\User',
    'middleware' => ['authheader']
], function () {
    Route::apiResource('user', 'AdminController')->only('index');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API\Admin',
    'middleware' => ['authheader']
], function () {
    Route::apiResources([
        'users' => 'UserController',
        'categories' => 'CategoryController',
        'subcategories' => 'SubCategoryController',
        'galleries' => 'GalleyController',
        'products' => 'ProductController',
        'configurations' => 'ConfigurationController'
    ]);

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
    Route::put('/configurations/image/{id}', 'ImageController@updateImageConfiguration')->name('configurations.image.update');
});
