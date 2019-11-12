<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/logout', 'Auth\LoginController@logout');
    
    Route::get('/data/vehicle/vehiclebrand', 'CS\Master\CustomerController@getBrandByCategory')->name('getVehicleBrand');
    Route::get('/data/vehicle/vehiclemodel', 'CS\Master\CustomerController@getModelByBrand')->name('getVehicleModel');
    Route::get('/data/group', 'UserManagement\GroupController@getUserGroups')->name('userGroupData');
    Route::get('/data/menu-detail-by-modul-id/{id}', 'UserManagement\GroupController@getMenuDetail')->name('menuDetailData');

    Route::group(['middleware' => 'UserHasNoOutlet'], function () {
        Route::get('/newuser', 'DashboardController@newUser_1');
        Route::get('/newuser/single-outlet', 'DashboardController@newUser_2');
        Route::post('/newuser/single-outlet/create', 'DashboardController@newOutlet')->name('newUserCreateSingleOutlet');
    });
    
    Route::group(['middleware' => 'UserHasOutlet'], function (){
        Route::get('/', 'DashboardController@index')->name('kava');
        // CUSTOMER SERVICE
        Route::get('/cs', 'CS\CSDashboardController@index')->name('cs');
        Route::get('/cs/master/customer', 'CS\Master\CustomerController@index')->name('customer');
        Route::get('/cs/master/customer/{customer_id}', 'CS\Master\CustomerController@index')->name('customerDetail');
        Route::post('/cs/master/customer/add', 'CS\Master\CustomerController@addCustomerPost')->name('addCustomerPost');

        // USER MANAGEMENT
        Route::get('/user-management', 'UserManagement\UMDashboardController@index')->name('userManagement');
        Route::get('/user-management/group', 'UserManagement\GroupController@index')->name('userGroups');
        Route::get('/user-management/group/{group}', 'UserManagement\GroupController@userGroupsDetail')->name('userGroupsDetail');
        Route::get('/user-management/group/getgroup/{id}', 'UserManagement\GroupController@getGroup')->name('getGroup');
        Route::get('/user-management/addgroup', 'UserManagement\GroupController@addGroup')->name('addGroup');
        Route::post('/user-management/addgroup/create', 'UserManagement\GroupController@addGroupPost')->name('addGroupPost');
        // Account
        Route::get('/user-management/account', 'UserManagement\UMDashboardController@index')->name('userAccounts');

        // GLOBAL SETTING
        Route::get('global-setting', 'GlobalSetting\GlobalSettingController@index');
        Route::get('global-setting/single-outlet', 'GlobalSetting\SingleOutletController@index');
    });

});