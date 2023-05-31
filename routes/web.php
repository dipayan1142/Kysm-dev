<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

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
// ---------- Authication routes start ----------

Route::get('login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('login', 'App\Http\Controllers\AuthController@postLogin');
Route::get('register', 'App\Http\Controllers\AuthController@register');
Route::post('register', 'App\Http\Controllers\AuthController@postRegister');
Route::get('logout', 'App\Http\Controllers\AuthController@logout');

// ----------- Authication routes end -----------

// Protected Routes Start
Route::middleware([Authenticate::class])->group(function () {
    Route::get('/', 'App\Http\Controllers\DashboardController@index');
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');

    // User Role Route Start
    Route::get('/users', 'App\Http\Controllers\UserrolemanagementController@index');
    Route::get('/users-add-user', 'App\Http\Controllers\UserrolemanagementController@add');
    Route::post('/create-user', 'App\Http\Controllers\UserrolemanagementController@create');
    Route::post('/delete-user', 'App\Http\Controllers\UserrolemanagementController@destroy');
    
    // User Role Route Stop

    // Banners Route Start
    Route::get('/banner/add', 'App\Http\Controllers\DashboardController@banneradd');
    Route::post('/banner/create', 'App\Http\Controllers\DashboardController@bannercreate');
    Route::post('/delete-banner', 'App\Http\Controllers\DashboardController@bannerdelete');
    Route::get('/banner/view/{id}', 'App\Http\Controllers\DashboardController@bannershow');
    Route::post('/banner/edit', 'App\Http\Controllers\DashboardController@banneredit');
    // Banners Route Stop
    // Gallery Route Start
    Route::get('/gallery', 'App\Http\Controllers\GalleryController@index');
    Route::get('/gallery/add', 'App\Http\Controllers\GalleryController@create');
    Route::post('/gallery/create', 'App\Http\Controllers\GalleryController@store');
    Route::post('/delete-gallery', 'App\Http\Controllers\GalleryController@destroy');
    Route::get('/gallery/view/{id}', 'App\Http\Controllers\GalleryController@show');
    Route::post('/gallery/edit', 'App\Http\Controllers\GalleryController@update');
    // Gallery Route Stop
    // Product Route Start
    Route::get('/product', 'App\Http\Controllers\ProductsController@index');
    Route::get('/product/add', 'App\Http\Controllers\ProductsController@create');
    // Route::post('/gallery/create', 'App\Http\Controllers\ProductsController@store');
    // Route::post('/delete-gallery', 'App\Http\Controllers\ProductsController@destroy');
    // Route::get('/gallery/view/{id}', 'App\Http\Controllers\ProductsController@show');
    // Route::post('/gallery/edit', 'App\Http\Controllers\ProductsController@update');
    // Product Route Stop
});
// Protecte Routes End

