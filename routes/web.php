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

Route::get('/', function () {
    return redirect('devices');
});



Route::get('save-random-password', 'HomeController@saveRandomPassword');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function() {
	
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('devices', 'DevicesController@index');
	Route::post('devices/add-device', 'DevicesController@addDevice');
	Route::post('devices/edit-device/{id}', 'DevicesController@editDevice');

	Route::get('settings', 'SettingsController@index');
	Route::post('settings/add-setting', 'SettingsController@addSetting');
	Route::post('settings/edit-setting/{id}', 'SettingsController@editSetting');

	Route::get('users', 'UsersController@index');
	Route::post('users/add-user', 'UsersController@addUser');
	Route::post('users/edit-user/{id}', 'UsersController@editUser');
	Route::post('users/assign_device', 'UsersController@assignDevice');
	Route::post('users/make_user_available', 'UsersController@makeUserAvailable');
});

Route::get('api/assigned_users_devices', 'DevicesController@getAssignedUsersDevices');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
