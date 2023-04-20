<?php

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

Route::group(['prefix' => 'admin'], function () {
	Auth::routes(['verify' => true]);
});

Route::get('user/verify/{token}', 'App\Http\Controllers\Auth\RegisterController@verifyUser');
Route::get('admin', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'permission'], function () {
	Route::get('/home', 'App\Http\Controllers\DashboardController@index')->name('admin.home');
	Route::get('logout', 'App\Http\Controllers\Auth\LoginController@adminLogout')->name('admin.logout');
	Route::get('export/users', 'App\Http\Controllers\UserController@export')->name('export.users');

	Route::resources([
		'users'       => 'App\Http\Controllers\UserController',
		'roles'       => 'App\Http\Controllers\RoleController',
		'contents'    => 'App\Http\Controllers\SiteContentController',
		'permissions' => 'App\Http\Controllers\PermissionController',
		'settings'    => 'App\Http\Controllers\SiteSettingController',
	]);

	Route::group(['prefix' => 'location'], function () {
		Route::resource('countries', 'App\Http\Controllers\LocationCountryController', ['as' => 'location']);
		Route::resource('countries.states', 'App\Http\Controllers\LocationStateController', ['as' => 'location']);
		Route::resource('countries.states.cities', 'App\Http\Controllers\LocationCityController', ['as' => 'location']);
	});

	Route::group(['prefix' => 'permissions'], function () {
		Route::get('manage_role/{id}', 'App\Http\Controllers\PermissionController@manageRole')->name('permissions.manage_role');
		Route::patch('assign/{id}', "App\Http\Controllers\PermissionController@assignPermission")->name('permissions.assign');
	});

	Route::group(['prefix' => 'setting'], function () {
		Route::post('export', 'App\Http\Controllers\SiteSettingController@settingsExport')->name('settings.export');
		Route::post('import', 'App\Http\Controllers\SiteSettingController@settingsImport')->name('settings.import');
	});

	Route::group(['prefix' => 'menus'], function () {
		Route::get('/{parent_id?}', 'App\Http\Controllers\MenuController@index')->name('menus.index');
		Route::get('create/{parent_id}', 'App\Http\Controllers\MenuController@create')->name('menus.create');
		Route::get('edit/{parent_id}/{id}', 'App\Http\Controllers\MenuController@edit')->name('menus.edit');
		Route::post('store', 'App\Http\Controllers\MenuController@store')->name('menus.store');
		Route::patch('update/{id}', 'App\Http\Controllers\MenuController@update')->name('menus.update');
		Route::delete('destroy/{parent_id}/{id}', 'App\Http\Controllers\MenuController@destroy')->name('menus.destroy');
	});

	Route::group(['prefix' => 'templates'], function () {
		Route::get('index', 'App\Http\Controllers\SiteTemplateController@index')->name('templates.index');
		Route::get('create', 'App\Http\Controllers\SiteTemplateController@create')->name('templates.create');
		Route::get('edit/{id}', 'App\Http\Controllers\SiteTemplateController@edit')->name('templates.edit');
		Route::post('store', 'App\Http\Controllers\SiteTemplateController@store')->name('templates.store');
		Route::patch('update/{id}', 'App\Http\Controllers\SiteTemplateController@update')->name('templates.update');
		Route::delete('destroy/{id}', 'App\Http\Controllers\iteTemplateController@destroy')->name('templates.destroy');
	});

	Route::group(['prefix' => 'ui'], function () {
		Route::get('icons', 'App\Http\Controllers\SiteSettingController@uiIcons')->name('ui.icons');
	});

	Route::group(['prefix' => 'course_management'], function () {
		Route::get('index', 'App\Http\Controllers\CourseModuleController@index')->name('module.index');
		Route::get('course', 'App\Http\Controllers\CourseController@index')->name('course.index');
		Route::get('create', 'App\Http\Controllers\CourseController@create')->name('course.create');
		Route::get('edit/{id}', 'App\Http\Controllers\CourseController@edit')->name('course.edit');
		Route::post('store', 'App\Http\Controllers\CourseController@store')->name('course.store');
		Route::patch('update/{id}', 'App\Http\Controllers\CourseController@update')->name('course.update');
		Route::delete('destroy/{id}', 'App\Http\Controllers\CourseController@destroy')->name('course.destroy');
	});

});

Auth::routes(['verify' => true]);
Route::get('/', 'App\Http\Controllers\HomeController@home')->name('home');
Route::group(['middleware' => 'auth'], function () {
	Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});
