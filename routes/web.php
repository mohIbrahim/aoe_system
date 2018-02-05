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
    Route::get('remove_the_installation_record_file/{project_image_id}', 'InstallationRecordController@removeInstallationRecordFile')->name('remove_the_installation_record_file');
//Contracts
    Route::resource('contracts', 'ContractController');
    Route::get('contracts_search/{keyword}', 'ContractController@search')->name('contracts_search');
    Route::get('remove_the_contract_file/{project_image_id}', 'ContractController@removeContractFile')->name('remove_the_contract_file');
//invoices
    Route::resource('invoices', 'InvoiceController');
    Route::get('invoices_search/{keyword}', 'InvoiceController@search')->name('invoices_search');
//Visits
    Route::resource('visits', 'VisitController');
    Route::get('visits_search/{keyword}', 'VisitController@search')->name('visits_search');
//Follow Up Cards
    Route::resource('follow_up_cards', 'FollowUpCardController');
    Route::get('follow_up_cards_search/{keyword}', 'FollowUpCardController@search')->name('follow_up_cards_search');
    Route::get('remove_follow_up_card_file/{project_image_id}', 'FollowUpCardController@removeFollowUpCardFile')->name('remove_follow_up_card_file');
//Follow Up Card special reports
    Route::resource('follow_up_card_special_reports', 'FollowUpCardSpecialReportController');
    Route::get('follow_up_card_special_reports_search/{keyword}', 'FollowUpCardSpecialReportController@search')->name('follow_up_card_special_reports_search');
//References
    Route::resource('references', 'ReferenceController');
    Route::get('references_search/{keyword}', 'ReferenceController@search')->name('references_search');
//Indexations
    Route::resource('indexations', 'IndexationController');
    Route::get('indexations_search/{keyword}', 'IndexationController@search')->name('indexations_search');
//Indexations
    Route::resource('employees', 'EmployeeController');
    Route::get('employees_search/{keyword}', 'EmployeeController@search')->name('employees_search');
