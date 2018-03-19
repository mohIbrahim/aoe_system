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
    Route::get('installation_records_pm_search/{keyword}', 'InstallationRecordController@searchingOnPrintingMachine')->name('installation_records_pm_search');
//Contracts
    Route::resource('contracts', 'ContractController');
    Route::get('contracts_search/{keyword}', 'ContractController@search')->name('contracts_search');
    Route::get('remove_the_contract_file/{project_image_id}', 'ContractController@removeContractFile')->name('remove_the_contract_file');
    Route::get('contracts_pm_search/{keyword}', 'ContractController@searchingOnPrintingMachinesByCustomerName')->name('contracts_pm_search');
    Route::get('create_contract_with_printing_machine_id/{pm_id}', 'ContractController@createWithPrintingMachineId')->name('create_contract_with_printing_machine_id');
    Route::get('contracts_invoices_are_due_in_this_month_report', 'ContractController@contractsInvoicesAreDueInThisMonthReport')->name('contracts_invoices_are_due_in_this_month_report');
//Invoices
    Route::resource('invoices', 'InvoiceController');
    Route::get('invoices_search/{keyword}', 'InvoiceController@search')->name('invoices_search');
    Route::get('remove_the_invoice_file/{project_image_id}', 'InvoiceController@removeInvoiceFile')->name('remove_the_invoice_file');
//Visits
    Route::resource('visits', 'VisitController');
    Route::get('visits_search/{keyword}', 'VisitController@search')->name('visits_search');
    Route::get('visits_pm_search/{keyword}', 'VisitController@searchingOnPrintingMachine')->name('visits_pm_search');
    Route::get('create_visit_with_printing_machine_id/{pm_id}', 'VisitController@createWithPrintingMachineId')->name('create_visit_with_printing_machine_id');
    Route::get('create_visit_with_printing_machine_id_and_follow_up_card_id/{printin_machine_id}/{follow_up_card_id}', 'VisitController@createWithPrintingMachineIdAndFollowUpCardId')->name('create_visit_with_printing_machine_id_and_follow_up_card_id');
//Follow Up Cards
    Route::resource('follow_up_cards', 'FollowUpCardController');
    Route::get('follow_up_cards_search/{keyword}', 'FollowUpCardController@search')->name('follow_up_cards_search');
    Route::get('remove_follow_up_card_file/{project_image_id}', 'FollowUpCardController@removeFollowUpCardFile')->name('remove_follow_up_card_file');
    Route::get('follow_up_card_pm_search/{keyword}', 'FollowUpCardController@searchingOnPrintingMachine')->name('follow_up_card_pm_search');
//Follow Up Card special reports
    Route::resource('follow_up_card_special_reports', 'FollowUpCardSpecialReportController');
    Route::get('follow_up_card_special_reports_search/{keyword}', 'FollowUpCardSpecialReportController@search')->name('follow_up_card_special_reports_search');
	Route::get('create_follow_up_card_special_reports_with_follow_up_card_id/{follow_up_card_id}', 'FollowUpCardSpecialReportController@createWithFollowUpCardId')->name('create_follow_up_card_special_reports_with_follow_up_card_id');
//References
    Route::resource('references', 'ReferenceController');
    Route::get('references_search/{keyword}', 'ReferenceController@search')->name('references_search');
    Route::get('remove_the_reference_file/{project_image_id}', 'ReferenceController@removeReferenceFile')->name('remove_the_reference_file');
    Route::get('references_pm_search/{keyword}', 'ReferenceController@searchingOnPrintingMachine')->name('references_pm_search');
    Route::get('create_reference_with_printing_machine_id/{pm_id}', 'ReferenceController@createWithPrintingMachineId')->name('create_reference_with_printing_machine_id');
    Route::get('reference_close/{reference_id}', 'ReferenceController@closeTheReference')->name('reference_close');
    Route::get('references_report_during_last_two_working_days','ReferenceController@referencesReportDuringLastTwoWorkingDays')->name('references_report_during_last_two_working_days');
//Indexations
    Route::resource('indexations', 'IndexationController');
    Route::get('indexations_search/{keyword}', 'IndexationController@search')->name('indexations_search');
    Route::get('remove_the_indexation_file/{project_image_id}', 'IndexationController@removeIndexationFile')->name('remove_the_indexation_file');
    Route::get('indexation_form_part_search/{keyword}', 'IndexationController@indexationFormPartSearch')->name('indexation_form_part_search');
//Employees
    Route::resource('employees', 'EmployeeController');
    Route::get('employees_search/{keyword}', 'EmployeeController@search')->name('employees_search');
    Route::get('employees_pm_search/{keyword}', 'EmployeeController@searchingOnPrintingMachine')->name('employees_pm_search');
