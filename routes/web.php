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

Route::get('/', 'StoreController@index')->name('store');

Auth::routes();

Route::prefix('admin')->group(function () 
{
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@adminLogin')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::namespace('Admin')->group(function () 
    {
        Route::get('/', 'HomeController@index')->name('admin.home');        
        Route::resource('configurations', 'ConfigurationController')->only('index', 'edit');
        Route::resource('users', 'UserController')->only('index', 'edit');
        Route::resource('admins', 'AdminController')->only('index');
        Route::resource('categories', 'CategoryController')->only('index');
        Route::resource('subcategories', 'SubCategoryController')->only('index');
        Route::resource('galleries', 'GalleryController')->only('index', 'edit');
        Route::resource('products', 'ProductController')->only('index', 'edit');
        Route::resource('users/{id}/edit/shippings', 'ShippingController')->only('index');
        Route::resource('products/{id}/edit/characteristic', 'CharacteristicController')->only('index');
        Route::resource('products/{id}/edit/photo', 'PhotoController')->only('index');
    });
});
