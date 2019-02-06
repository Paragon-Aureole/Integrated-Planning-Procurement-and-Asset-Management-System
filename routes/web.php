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

//add distributors
Route::get('/distributor', 'DistributorController@index')->name('view.dist');
Route::post('/distributor/new', 'DistributorController@store')->name('add.dist');
Route::get('/distributor/edit/{id}', 'DistributorController@edit')->name('edit.dist');
Route::put('/distributor/update/{id}', 'DistributorController@update')->name('update.dist');
Route::get('/distributor/delete/{id}', 'DistributorController@destroy')->name('delete.dist');

//add ppmp
Route::get('/ppmp', 'PpmpController@index')->name('view.ppmp');
Route::post('/ppmp/new', 'PpmpController@store')->name('add.ppmp');
// Route::get('/distributor/edit/{id}', 'PpmpController@edit')->name('edit.ppmp');
// Route::put('/distributor/update/{id}', 'PpmpController@update')->name('update.ppmp');
Route::get('/ppmp/delete/{id}', 'PpmpController@destroy')->name('delete.ppmp');

//add ppmp items
Route::get('/ppmp/item', 'PpmpItemController@index')->name('view.ppmpitm');
Route::post('/ppmp/item/add', 'PpmpItemController@store')->name('add.ppmpitm');
Route::get('/ppmp/item/edit/{id}', 'PpmpItemController@edit')->name('edit.ppmpitm');
Route::put('/ppmp/item/update/{id}', 'PpmpItemController@update')->name('update.ppmpitm');
Route::get('/ppmp/item/delete/{id}', 'PpmpItemController@destroy')->name('delete.ppmpitm');