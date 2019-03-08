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
    return view('auth.login');
});
Route::view('/forbidden', 'errors.403');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// edit user
Route::get('/register/edit/{id}','Auth\RegisterController@edit')->name('edit.user');
// update user
Route::put('/register/update/{id}','Auth\RegisterController@update')->name('update.user');
// delete user
Route::get('/register/delete/{id}','Auth\RegisterController@destroy')->name('delete.user');
// restore user
Route::get('/register/restore/{id}','Auth\RegisterController@restore')->name('restore.user');

//add department
Route::get('/office', 'OfficeController@index')->name('view.office');
Route::post('/office/new', 'OfficeController@store')->name('add.office');
Route::get('/office/edit/{id}', 'OfficeController@edit')->name('edit.office');
Route::put('/office/update/{id}', 'OfficeController@update')->name('update.office');
Route::get('/office/delete/{id}', 'OfficeController@destroy')->name('delete.office');

//add method of procurement
Route::get('/procurement', 'ProcurementModeController@index')->name('view.modes');
Route::post('/procurement/new', 'ProcurementModeController@store')->name('add.modes');
Route::get('/procurement/edit/{id}', 'ProcurementModeController@edit')->name('edit.modes');
Route::put('/procurement/update/{id}', 'ProcurementModeController@update')->name('update.modes');
Route::get('/procurement/delete/{id}', 'ProcurementModeController@destroy')->name('delete.modes');

//add units of measurements
Route::get('/unit', 'MeasurementUnitController@index')->name('view.units');
Route::post('/unit/new', 'MeasurementUnitController@store')->name('add.units');
Route::get('/unit/edit/{id}', 'MeasurementUnitController@edit')->name('edit.units');
Route::put('/unit/update/{id}', 'MeasurementUnitController@update')->name('update.units');
Route::get('/unit/delete/{id}', 'MeasurementUnitController@destroy')->name('delete.units');

//add signatory
Route::get('/signatory', 'SignatoryController@index')->name('view.signatories');
Route::post('/signatory/new', 'SignatoryController@store')->name('add.signatories');
Route::get('/signatory/edit/{id}', 'SignatoryController@edit')->name('edit.signatories');
Route::put('/signatory/update/{id}', 'SignatoryController@update')->name('update.signatories');
Route::get('/signatory/delete/{id}', 'SignatoryController@destroy')->name('delete.signatories');
Route::get('/signatory/activate/{id}', 'SignatoryController@activateSignatory')->name('activate.signatories');
Route::get('/signatory/deactivate/{id}', 'SignatoryController@deactivateSignatory')->name('deactivate.signatories');

//add distributors
Route::get('/distributor', 'DistributorController@index')->name('view.dist');
Route::post('/distributor/new', 'DistributorController@store')->name('add.dist');
Route::get('/distributor/edit/{id}', 'DistributorController@edit')->name('edit.dist');
Route::put('/distributor/update/{id}', 'DistributorController@update')->name('update.dist');
Route::get('/distributor/delete/{id}', 'DistributorController@destroy')->name('delete.dist');

//add ppmp
Route::get('/ppmp', 'PpmpController@index')->name('view.ppmp');
Route::post('/ppmp/new', 'PpmpController@store')->name('add.ppmp');
// Route::put('/ppmp/update/{id}', 'PpmpController@update')->name('update.ppmp');
Route::get('/ppmp/delete/{id}', 'PpmpController@destroy')->name('delete.ppmp');
Route::get('/ppmp/activate/{id}', 'PpmpController@activatePpmp')->name('activate.ppmp');
Route::get('/ppmp/deactivate/{id}', 'PpmpController@deactivatePpmp')->name('deactivate.ppmp');

Route::get('ppmp/print/{id}', 'PpmpController@printPpmp')->name('print.ppmp');

//ppmp code
Route::get('/ppmp/{id}/code/view/' , 'PpmpItemCodeController@index')->name('view.ppmpitemcode');
Route::post('/ppmp/{id}/code/new', 'PpmpItemCodeController@store')->name('add.ppmpitemcode');
Route::get('/ppmp/{ppmp_id}/code/edit/{ppmpcode_id}', 'PpmpItemCodeController@edit')->name('edit.ppmpitemcode');
Route::put('/ppmp/code/update/{id}', 'PpmpItemCodeController@update')->name('update.ppmpitemcode');
Route::get('/ppmp/code/delete/{id}', 'PpmpItemCodeController@destroy')->name('delete.ppmpitemcode');


//PPMP Budget
Route::get('/ppmp/budget/add/{id}', 'PpmpController@addPpmpBudget')->name('add.ppmp.budget');

//add ppmp items
Route::get('/ppmp/{id}/item', 'PpmpItemController@index')->name('view.ppmpitm');
Route::post('/ppmp/{id}/item/add', 'PpmpItemController@store')->name('add.ppmpitm');
Route::get('/ppmp/{ppmp_id}/item/edit/{item_id}', 'PpmpItemController@edit')->name('edit.ppmpitm');
Route::put('/ppmp/{ppmp_id}/item/update/{id}', 'PpmpItemController@update')->name('update.ppmpitm');
Route::get('/ppmp/{ppmp_id}/item/delete/{id}', 'PpmpItemController@destroy')->name('delete.ppmpitm');


//add purchase reuest
Route::get('/pr', 'PurchaseRequestController@index')->name('view.pr');
Route::post('/pr/new/add', 'PurchaseRequestController@store')->name('add.pr');
Route::get('/pr/edit/{id}', 'PurchaseRequestController@edit')->name('edit.pr');
Route::put('/pr/update/{id}', 'PurchaseRequestController@update')->name('update.pr');
Route::get('/pr/delete/{id}', 'PurchaseRequestController@destroy')->name('delete.pr');
Route::get('/pr/print/{id}', 'PurchaseRequestController@printPurchaseRequest')->name('print.pr');


//AJAX Data Routes
Route::get('/pr/ppmp/get/{id}', 'PurchaseRequestController@getPpmpData')->name('get.ppmp');
Route::get('/pr/dist/get', 'PurchaseRequestController@getDistributorData')->name('get.dist');
Route::get('/pr/item/get/{id}', 'PurchaseRequestItemController@getItemData')->name('get.itmdata');

//add purchase request items
Route::get('/pr/{id}/item', 'PurchaseRequestItemController@index')->name('view.pritm');
Route::post('/pr/{id}/item/add', 'PurchaseRequestItemController@store')->name('add.pritm');
Route::get('/pr/{pr_id}/item/edit/{item_id}', 'PurchaseRequestItemController@edit')->name('edit.pritm');
Route::put('/pr/{pr_id}/item/update/{id}', 'PurchaseRequestItemController@update')->name('update.pritm');
Route::get('/pr/{pr_id}/item/delete/{id}', 'PurchaseRequestItemController@destroy')->name('delete.pritm');
