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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
});
Route::group(['middleware' => 'auth'], function () {

    Route::get('/data/group', 'UserManagement\GroupController@getUserGroups')->name('userGroupData');
    Route::get('/data/menu-detail-by-modul-id/{id}', 'UserManagement\GroupController@getMenuDetail')->name('menuDetailData');

    Route::get('/', 'DashboardController@index');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/user-management', 'UserManagement\UMDashboardController@index');
    Route::get('/user-management/group', 'UserManagement\GroupController@index')->name('userGroups');
    Route::get('/user-management/group/{group}', 'UserManagement\GroupController@userGroupsDetail')->name('userGroupsDetail');
    Route::get('/user-management/account', 'UserManagement\UMDashboardController@index')->name('userAccounts');
});
Auth::routes();