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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    "prefix" => "v1",
    "namespace" => "Api"
], function(){
    Route::apiResources([
        'admins' => 'AdminController',
        'users' => 'UserController',
        'categories' => 'CategoryController',
        'subcategories' => 'SubCategoryController',
        'products' => 'ProductController',
        'configurations' => 'ConfigurationController'
    ]);

    Route::apiResource('characteristics', 'CharacteristicController')->except('index');
    Route::get('/characteristics/all/{id}', 'CharacteristicController@index')->name('characteristics.index');

    Route::apiResource('shippings', 'ShippingController')->except('index');
    Route::get('/shippings/all/{id}', 'ShippingController@index')->name('shippings.index');

    Route::put('/adminpassword/{id}', 'UserPasswordController@updateAdmin')->name('admins.password.update');
    Route::put('/userpassword/{id}', 'UserPasswordController@updateUser')->name('users.password.update');
});
