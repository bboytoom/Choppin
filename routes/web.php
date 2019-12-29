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

Route::namespace('Store')->group(function () 
{
    Route::get('/', 'HomeController@index')->name('home');
});

Auth::routes();

Route::prefix('admin')->group(function () 
{
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@adminLogin')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::namespace('Admin')->group(function () 
    {
        Route::get('/', 'HomeController@index')->name('admin.home');        
        Route::resource('users', 'UserController')->only('index', 'edit');
        Route::resource('admins', 'AdminController')->only('index');
        Route::resource('categories', 'CategoryController')->only('index');
        Route::resource('subcategories', 'SubCategoryController')->only('index');
    });
});

Route::prefix('user')->group(function () 
{
    Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

    Route::namespace('Users')->group(function () 
    {
        Route::get('/', 'HomeController@index')->name('user.home');
    });
});
