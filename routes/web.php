<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', 'Auth\LoginController@logout');

    Route::get('/data/customer/getcustomer/{customer_id}', 'CS\Master\CustomerController@getCustomerByID')->name('getCustomer');
    Route::get('/data/vehicle/vehiclebrand', 'CS\Master\CustomerController@getBrandByCategory')->name('getVehicleBrand');
    Route::get('/data/vehicle/vehiclemodel', 'CS\Master\CustomerController@getModelByBrand')->name('getVehicleModel');
    Route::get('/data/vehicle/get/{id}', 'CS\Master\VehicleController@getVehicleByID')->name('getVehicle');
    Route::get('/data/feedback/get/{id}', 'CS\Master\FeedbackController@getFeedbackByID')->name('getFeedback');
    Route::get('/data/membership/get/{id}', 'CS\Master\MembershipController@getMembershipByID')->name('getMembership');
    Route::get('/data/service/get/{id}', 'CS\Master\ServiceController@getServiceByID')->name('getService');
    Route::get('/data/customer/search', 'CS\Transaction\CheckInOutController@searchCustomer')->name('searchCustomer');
    Route::get('/data/account/get/{id}', 'UserManagement\AccountController@getAccountByID')->name('getAccount');
    Route::get('/data/checkin/customer/{id}', 'CS\Transaction\CheckInOutController@getCustomerDetailByID')->name('getCustomerCheckIn');
    Route::get('/data/items/getitem/{id}', 'POS\Transaction\CashRegisterController@getItemByID')->name('getItemID');
    Route::get('/data/items/getitems', 'POS\Transaction\CashRegisterController@getAllItems')->name('getItems');
    Route::get('/data/items/getserviceitems/{id}', 'CS\Transaction\CheckInOutController@getServiceItem')->name('getServiceItems');
    Route::get('/data/cashier/getcashierbyid', 'POS\Transaction\CashRegisterController@getCashierByID')->name('getcashierByID');
    Route::get('/data/local-setting/getsetting', 'POS\Transaction\CashRegisterController@getSetting')->name('getSetting');
    Route::get('/data/promo/get', 'POS\Transaction\CashRegisterController@getTodaysPromo')->name('getTodaysPromo');
    Route::get('/data/promo/getvisitpromo', 'POS\Transaction\CashRegisterController@getVisitPromo')->name('getVisitPromo');
    Route::get('/data/checkin/getcustomerdetail/{id}', 'CS\Transaction\CheckInOutController@getCheckedInCustomerDetail');
    Route::get('/data/checkin/getcustomer/{id}', 'CS\Transaction\CheckInOutController@getCheckedInCustomer');
    Route::get('/data/complaint-handling/getcustomer/{id}', 'CS\Transaction\ComplaintHandlingController@getComplaintCustomer')->name('getComplaintCustomer');
    Route::get('/data/complaint-handling/get/{id}', 'CS\Transaction\ComplaintHandlingController@getComplaintCustomerByID')->name('getComplaintCustomerByID');
    // Route::get('/data/complaint-handling/get/{id}', 'CS\Transaction\ComplaintHandlingeController@getLicensePlate')->name('getLicensePlate');
    Route::get('/data/promo/getpromofree/{customer_detail_id}/{promo_id}', 'POS\Transaction\CashRegisterController@getPromoFree')->name('getPromoFree');
    Route::get('/data/promo/getpromoitem', 'POS\Transaction\CashRegisterController@getPromoItem')->name('getPromoItem');
    Route::get('/data/promo/getallpromo', 'POS\Transaction\CashRegisterController@getAllPromo')->name('getAllPromo');

    Route::get('/data/checkin/countVisitItem/{customer_detail_id}/{item_id}', 'POS\Transaction\CashRegisterController@getCustomerVisitByItemID');
    Route::get('/data/checkin/getcheckedincustomer/{customer_detail_id}', 'POS\Transaction\CashRegisterController@getCheckedInCustomer');
    Route::get('/data/membership/getMembershipByID/{membership_id}', 'CS\Transaction\MembershipController@getMembershipByID');

    Route::get('/data/customerdetail/get/{id}', 'CS\Master\CustomerController@getCustomerDetail')->name('getCustomerDetail');
    Route::get('/data/group', 'UserManagement\GroupController@getUserGroups')->name('userGroupData');
    Route::get('/data/menu-detail-by-modul-id/{id}', 'UserManagement\GroupController@getMenuDetail')->name('menuDetailData');
    Route::get('/data/cashier/get/{id}', 'CS\Master\CashierController@getCashier')->name('getCashier');


    Route::get('/data/cash-bank-out/getbankaccountnumber', 'POS\Transaction\CashBankOutController@getBankAccountNumberByBankID')->name('getBankAccountNumberByBankID');
    Route::get('/data/cash-bank-out/getbankaccountbeginingbalance', 'POS\Transaction\CashBankOutController@getBankAccountBeginingBalanceByBankAccountID')->name('getBankAccountBeginingBalanceByBankAccountID');
    Route::get('/data/cash-bank-out/getpettycashremainingbalance', 'POS\Transaction\CashBankOutController@getPettyCashRemainingBalanceByOutlet')->name('getPettyCashRemainingBalanceByOutlet');
    Route::get('/data/cash-bank-out/getPettyCashID', 'POS\Transaction\CashBankOutController@getPettyCashIDByLastDate')->name('getPettyCashIDByLastDate');
    Route::get('/data/cash-bank-out/getpettycashdetailbalanced', 'POS\Transaction\CashBankOutController@getPettyCashDetailBalancedList')->name('getPettyCashDetailBalancedList');
    Route::get('/data/cash-bank-out/getpettycashamount', 'POS\Transaction\CashBankOutController@getPettyCashAmountByFlag')->name('getPettyCashAmountByFlag');
    


    Route::group(['middleware' => 'UserHasNoOutlet'], function () {
        Route::get('/newuser', 'DashboardController@newUser_1');
        Route::get('/newuser/single-outlet', 'DashboardController@newUser_2');
        Route::post('/newuser/single-outlet/create', 'DashboardController@newOutlet')->name('newUserCreateSingleOutlet');
    });

    Route::group(['middleware' => 'UserHasOutlet'], function () {
        Route::get('/', 'DashboardController@index')->name('kava');
        // CUSTOMER SERVICE
        // Customer
        Route::get('/cs', 'CS\CSDashboardController@index')->name('cs');
        Route::get('/cs/master/customer', 'CS\Master\CustomerController@index')->name('customer');
        Route::post('/cs/master/customer/add', 'CS\Master\CustomerController@store')->name('addCustomerPost');
        Route::delete('/cs/master/customer/delete', 'CS\Master\CustomerController@destroy')->name('deleteCustomer');
        Route::get('/cs/master/customer/{customer_id}', 'CS\Master\CustomerController@show')->name('customerDetail');
        Route::post('/cs/master/customer/{customer_id}/addvehicle', 'CS\Master\CustomerController@storeDetail')->name('addCustomerDetail');
        Route::post('/cs/master/customer/{customer_id}/edit/{customer_detail_id?}', 'CS\Master\CustomerController@updateDetail')->name('editCustomer');
        Route::delete('/cs/master/customer/deletevehicle', 'CS\Master\CustomerController@destroyDetail')->name('deleteCustomerDetail');
        Route::get('/cs/local-setting', 'CS\LocalSettingController@index')->name('CSLocalSetting');
        // Vehicle
        Route::get('/cs/master/vehicle', 'CS\Master\VehicleController@index')->name('vehicle');
        Route::post('/cs/master/vehicle/add', 'CS\Master\VehicleController@store')->name('storeVehicle');
        Route::delete('/cs/master/vehicle/delete', 'CS\Master\VehicleController@destroy')->name('destroyVehicle');
        Route::post('/cs/master/vehicle/{id}/edit', 'CS\Master\VehicleController@update')->name('updateVehicle');
        // Service
        Route::get('/cs/master/service', 'CS\Master\ServiceController@index')->name('service');
        Route::post('/cs/master/service/add', 'CS\Master\ServiceController@store')->name('storeService');
        Route::delete('/cs/master/service/delete', 'CS\Master\ServiceController@destroy')->name('destroyService');
        Route::post('/cs/master/service/{id}/edit', 'CS\Master\ServiceController@update')->name('updateService');
        // Membership
        Route::get('/cs/master/membership', 'CS\Master\MembershipController@index')->name('membership');
        Route::post('/cs/master/membership/add', 'CS\Master\MembershipController@store')->name('storeMembership');
        Route::delete('/cs/master/membership/delete', 'CS\Master\MembershipController@destroy')->name('destroyMembership');
        Route::post('/cs/master/membership/{id}/edit', 'CS\Master\MembershipController@update')->name('updateMembership');
        // Feedback
        // master
        Route::get('/cs/master/feedback', 'CS\Master\FeedbackController@index')->name('feedback');
        Route::post('/cs/master/feedback/add', 'CS\Master\FeedbackController@store')->name('storeFeedback');
        Route::delete('/cs/master/feedback/delete', 'CS\Master\FeedbackController@destroy')->name('destroyFeedback');
        Route::post('/cs/master/feedback/{id}/edit', 'CS\Master\FeedbackController@update')->name('updateFeedback');

        // Check In
        Route::get('/cs/transaction/check-in-out', 'CS\Transaction\CheckInOutController@index')->name('checkInOut');
        Route::post('/cs/transaction/check-in-out/checkin', 'CS\Transaction\CheckInOutController@store')->name('checkIn');
        Route::post('/cs/transaction/check-in-out/checkout/{id}', 'CS\Transaction\CheckInOutController@checkOut')->name('checkOut');
        // Membership
        Route::get('/cs/transaction/membership', 'CS\Transaction\MembershipController@index')->name('membershipTransaction');
        // Promo Item
        Route::get('/cs/master/promo-item', 'CS\Master\PromoItemController@index')->name('promoItem');
        Route::post('/cs/master/promo-item/add', 'CS\Master\PromoItemController@store')->name('storePromoItem');
        Route::post('/cs/master/membership/{id}/edit', 'CS\Master\MembershipController@update')->name('updateMembership');
        // Complaint Handling
        Route::get('/cs/transaction/complaint-handling', 'CS\Transaction\ComplaintHandlingController@index')->name('complaintHandlingTransaction');
        Route::post('/cs/transaction/complaint-handling/add', 'CS\Transaction\ComplaintHandlingController@store')->name('storeComplaintHandlingTransaction');
        Route::post('/cs/transaction/complaint-handling/{id}/edit', 'CS\Transaction\ComplaintHandlingController@update')->name('updateComplaintHandlingTransaction');
        Route::delete('/cs/transaction/complaint-handling/delete', 'CS\Transaction\ComplaintHandlingController@destroy')->name('destroyComplaintHandlingTransaction');





        // POS
        // Master---------
        // Cash Account
        Route::get('/pos', 'POS\POSDashboardController@index')->name('pos');
        Route::get('/pos/master/cash-account', 'POS\Master\CashAccountController@index');
        Route::post('/pos/master/cash-account/add-bank-account', 'POS\Master\CashAccountController@storeBankAccount')->name('storeBankAccount');
        // Cashier
        Route::get('/pos/master/cashier', 'POS\Master\CashierController@index')->name('cashier');
        Route::post('/pos/master/cashier/addcashier', 'POS\Master\CashierController@store')->name('storeCashier');
        // Transaction-----
        // Open Store
        Route::get('/pos/transaction/open-store', 'POS\Transaction\OpenStoreController@index')->name('openStore');
        Route::post('/pos/transaction/open-store/add', 'POS\Transaction\OpenStoreController@store')->name('storeOpenStore');
        // Cash Register
        Route::get('/pos/transaction/cash-drawer', 'POS\Transaction\CashRegisterController@index')->name('cashRegister');
        Route::post('/pos/transaction/cash-drawer/pay/{customer_detail_id}', 'POS\Transaction\CashRegisterController@store')->name('cashRegisterStore');
        Route::get('/pos/local-setting', 'POS\LocalSettingController@index')->name('POSLocalSetting');
        Route::post('/pos/local-setting/number', 'POS\LocalSettingController@store')->name('storePOSLocalSetting');
        Route::post('/pos/transaction/promo-free', 'POS\Transaction\CashRegisterController@storePromoFree')->name('storePromoFree');
        // Debit Credit Note
        Route::get('/pos/transaction/debit-credit-note', 'POS\Transaction\DebitCreditNoteController@index')->name('debitCreditNote');
        Route::post('/pos/transaction/debit-credit-note/add', 'POS\Transaction\DebitCreditNoteController@store')->name('storeDebitCreditNote');
        // Cash & Bank Out
        Route::get('/pos/transaction/cash-bank-out', 'POS\Transaction\CashBankOutController@index')->name('cashBankOutTransaction');
        Route::post('/pos/transaction/cash-bank-out/add', 'POS\Transaction\CashBankOutController@store')->name('storeCashBankOutTransaction');
        // Petty Cash
        Route::get('/pos/transaction/cash-bank-out/petty-cash-out', 'POS\Transaction\PettyCashOutController@index')->name('pettyCashOutTransaction');
        Route::post('/pos/transaction/petty-cash/{id}/edit', 'POS\Transaction\PettyCashController@update')->name('updatePettyCashTransaction');
        Route::delete('/pos/transaction/petty-cash/delete', 'POS\Transaction\PettyCashController@destroy')->name('destroyPettyCashTransaction');
        // Bank Out
        Route::get('/pos/transaction/cash-bank-out/bank-out', 'POS\Transaction\BankOutController@index')->name('bankOutTransaction');
        // Change Shift
        Route::get('/pos/transaction/change-shift', 'POS\Transaction\ChangeShiftController@index')->name('changeShiftTransaction');






        // USER MANAGEMENT
        Route::get('/user-management', 'UserManagement\UMDashboardController@index')->name('userManagement');
        Route::get('/user-management/group', 'UserManagement\GroupController@index')->name('userGroups');
        Route::get('/user-management/group/{group}', 'UserManagement\GroupController@edit')->name('userGroupsEdit');
        Route::post('/user-management/group/{group}/edit', 'UserManagement\GroupController@update')->name('userGroupUpdate');
        Route::get('/user-management/group/getgroup/{id}', 'UserManagement\GroupController@getGroup')->name('getGroup');
        Route::get('/user-management/addgroup', 'UserManagement\GroupController@create')->name('addGroup');
        Route::post('/user-management/addgroup/create', 'UserManagement\GroupController@store')->name('addGroupPost');
        // Account
        Route::get('/user-management/account', 'UserManagement\AccountController@index')->name('userAccounts');
        Route::post('/user-management/account/add', 'UserManagement\AccountController@store')->name('storeAccount');
        Route::post('/user-management/account/{account}/edit', 'UserManagement\AccountController@update')->name('updateAccount');

        // GLOBAL SETTING
        Route::get('global-setting', 'GlobalSetting\GlobalSettingController@index');
        Route::get('global-setting/single-outlet', 'GlobalSetting\SingleOutletController@index');
    });
});
