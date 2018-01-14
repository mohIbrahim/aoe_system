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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('users', 'UserController');
Route::resource('role_user', 'RoleUserController');
//Printing Machines
    Route::resource('printing_machines', 'PrintingMachineController');
    Route::get('printing_machines_search/{keyword}', 'PrintingMachineController@search')->name('printing_machines_search');
//Customers
    Route::resource('customers', 'CustomerController');
    Route::get('customers_search/{keyword}', 'CustomerController@search')->name('customers_search');
//Reading of Printing Machines
    Route::resource('readings_of_printing_machine', 'ReadingOfPrintingMachineController');
//Departments
    Route::resource('departments', 'DepartmentController');
//parts
    Route::resource('parts', 'PartController');
    Route::get('parts_search/{keyword}', 'PartController@search')->name('parts_search');
//Part Serial partSerialNumbers
    Route::resource('part_serial_numbers', 'PartSerialNumberController');
    Route::get('part_serial_numbers_search/{keyword}', 'PartSerialNumberController@search')->name('part_serial_numbers_search');
//Installation Records
    Route::resource('installation_records', 'InstallationRecordController');
