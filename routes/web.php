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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/data/group', 'UserManagement\GroupController@getUserGroups')->name('userGroupData');
    Route::get('/data/menu-detail-by-modul-id/{id}', 'UserManagement\GroupController@getMenuDetail')->name('menuDetailData');

    Route::get('/', 'DashboardController@index');
    Route::get('/newuser', 'DashboardController@newUser_1');
    Route::get('/logout', 'Auth\LoginController@logout');

    // USER MANAGEMENT
    Route::get('/user-management', 'UserManagement\UMDashboardController@index');
    Route::get('/user-management/group', 'UserManagement\GroupController@index')->name('userGroups');
    Route::get('/user-management/group/{group}', 'UserManagement\GroupController@userGroupsDetail')->name('userGroupsDetail');
    // Account
    Route::get('/user-management/account', 'UserManagement\UMDashboardController@index')->name('userAccounts');

    // GLOBAL SETTING
    Route::get('global-setting', 'GlobalSetting\GlobalSettingController@index');
    Route::get('global-setting/single-outlet', 'GlobalSetting\SingleOutletController@index');
});
Auth::routes();