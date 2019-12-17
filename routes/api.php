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
        'admins' => 'AdminsController',
        'users' => 'UsersController',
        'category' => 'CategoryController',
        'subcategory' => 'SubCategoryController',
        'product' => 'ProductController',
        'characteristic' => 'CharacteristicController',
        'shipping' => 'ShippingController'
    ]);

    Route::put('/adminpassword/{id}', 'UserPasswordController@updateAdmin')->name('admins.password.update');
    Route::put('/userpassword/{id}', 'UserPasswordController@updateUser')->name('users.password.update');
});
