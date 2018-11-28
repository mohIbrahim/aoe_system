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

//Dashboard
    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
    
//Printing Machines
    Route::resource('printing_machines', 'PrintingMachineController');
    Route::get('printing_machines_search/{keyword}', 'PrintingMachineController@search')->name('printing_machines_search');
    Route::get('create_printing_machine_with_customer/{customer_id}', 'PrintingMachineController@createWithCustomerId')->name('create_printing_machine_with_customer');
    Route::get('printing_machines_as_excel', 'PrintingMachineController@getAllPrintingMachinesAsExcel')->name('printing_machines_as_excel');
    Route::get('printing_machines_without_follow_up_cards_report', 'PrintingMachineController@getPrintingMachinesWithoutFollowUpCardsReport')->name('printing_machines_without_follow_up_cards_report');
    
//Customers
    Route::resource('customers', 'CustomerController');
    Route::get('customers_search/{keyword}', 'CustomerController@search')->name('customers_search');
    Route::get('customers_as_excel', 'CustomerController@getCustomersAsExcel')->name('customers_as_excel');
    
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
    Route::get('create_installtion_record_with_printing_machine/{priting_machine_id}', 'InstallationRecordController@createWithPrintingMachineId')->name('create_installtion_record_with_printing_machine');

//Contracts
    Route::resource('contracts', 'ContractController');
    Route::get('contracts_search/{keyword}', 'ContractController@search')->name('contracts_search');
    Route::get('remove_the_contract_file/{project_image_id}', 'ContractController@removeContractFile')->name('remove_the_contract_file');
    Route::get('contracts_pm_search/{keyword}', 'ContractController@searchingOnPrintingMachinesByCustomerName')->name('contracts_pm_search');
    Route::get('create_contract_with_printing_machine_id/{pm_id}', 'ContractController@createWithPrintingMachineId')->name('create_contract_with_printing_machine_id');
    Route::get('contracts_invoices_are_due_in_this_month_report', 'ContractController@contractsInvoicesAreDueInThisMonthReport')->name('contracts_invoices_are_due_in_this_month_report');
    Route::get('contracts_expire_within_next_3_monthes_report', 'ContractController@contractsThatWillExpireWithinTheNextThreeMonthesReport')->name('contracts_expire_within_next_3_monthes_report');
    Route::get('contracts_released_or_end_during_a_certain_period_report', 'ContractController@getContractsReleasedOrEndDuringACertainPeriodReportView')->name('contracts_released_or_end_during_a_certain_period_report');
    Route::get('contracts_released_or_end_during_a_certain_period_search/{from}/{to}/{isEndDate}', 'ContractController@getContractsReleasedOrEndDuringACertainPeriodReportSearch')->name('contracts_released_or_end_during_a_certain_period_search');

//Invoices
    Route::resource('invoices', 'InvoiceController');
    Route::get('invoices_search/{keyword}', 'InvoiceController@search')->name('invoices_search');
    Route::get('remove_the_invoice_file/{project_image_id}', 'InvoiceController@removeInvoiceFile')->name('remove_the_invoice_file');
    Route::get('invoices_form_part_search/{keyword}', 'InvoiceController@invoiceFormPartSearch')->name('invoices_form_part_search');
    Route::get('create_invoice_with_customer/{customer_id}', 'InvoiceController@createWithCustomerId')->name('create_invoice_with_customer');
    Route::get('create_invoice_with_customer_and_indexation/{customer_id}/{indexation_id}', 'InvoiceController@createWithCustomerIdAndIndexationId')->name('create_invoice_with_customer_and_indexation');
    Route::get('get_invoices_released_in_specific_period_report', 'InvoiceController@getInvoicesReleasedInSpecificPeriodReport')->name('get_invoices_released_in_specific_period_report');
    Route::get('invoices_released_in_specific_period_report_search/{from}/{to}', 'InvoiceController@invoicesReleasedInSpecificPeriodReportSearch')->name('invoices_released_in_specific_period_report_search');
    Route::get('invoices_form_customer_search/{keyword}', 'InvoiceController@invoiceFormCustomerSearch')->name('invoices_form_customer_search');

//Visits
    Route::resource('visits', 'VisitController');
    Route::get('visits_search/{keyword}', 'VisitController@search')->name('visits_search');
    Route::get('visits_pm_search/{keyword}', 'VisitController@searchingOnPrintingMachine')->name('visits_pm_search');
    Route::get('create_visit_with_printing_machine_id/{pm_id}', 'VisitController@createWithPrintingMachineId')->name('create_visit_with_printing_machine_id');
    Route::get('create_visit_with_printing_machine_id_and_follow_up_card_id/{printin_machine_id}/{follow_up_card_id}', 'VisitController@createWithPrintingMachineIdAndFollowUpCardId')->name('create_visit_with_printing_machine_id_and_follow_up_card_id');
    Route::get('create_visit_with_printing_machine_id_and_reference_id_and_employee_id/{printin_machine_id}/{reference_id}/{employee_id}', 'VisitController@createWithPrintingMachineIdAndReferenceId')->name('create_visit_with_printing_machine_id_and_reference_id_and_employee_id');
    Route::get('remove_the_visit_file/{project_image_id}', 'VisitController@removeVisitFile')->name('remove_the_visit_file');
    Route::get('index_visits_in_specific_period_report', 'VisitController@indexVisitsInSpecificPeriodReport')->name('index_visits_in_specific_period_report');
    Route::get('get_visits_in_specific_period_report/{from}/{to}', 'VisitController@getVisitsInSpecificPeriodReport')->name('get_visits_in_specific_period_report');
    Route::get('visits_as_excel', 'VisitController@getAllVisitsAsExcel')->name('visits_as_excel');
    
//Follow Up Cards
    Route::resource('follow_up_cards', 'FollowUpCardController');
    Route::get('follow_up_cards_search/{keyword}', 'FollowUpCardController@search')->name('follow_up_cards_search');
    Route::get('remove_follow_up_card_file/{project_image_id}', 'FollowUpCardController@removeFollowUpCardFile')->name('remove_follow_up_card_file');
    Route::get('follow_up_card_pm_search/{keyword}', 'FollowUpCardController@searchingOnPrintingMachine')->name('follow_up_card_pm_search');
    Route::get('visits_not_done_on_time_for_follow_up_cards_report', 'FollowUpCardController@visitsNotDoneOnTimeReport')->name('visits_not_done_on_time_for_follow_up_cards_report');
    Route::get('visits_not_done_on_time_for_follow_up_cards_report_search/{start}/{end}', 'FollowUpCardController@visitsNotDoneOnTimeReportSearch')->name('visits_not_done_on_time_for_follow_up_cards_report_search');
    Route::get('follow_up_cards_create_from_printing_machine_show_view', 'FollowUpCardController@createFromPrintingMachineShowView')->name('follow_up_cards_create_from_printing_machine_show_view');
    
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
    Route::get('references_during_last_two_working_days_report','ReferenceController@referencesDuringLastTwoWorkingDaysReport')->name('references_during_last_two_working_days_report');
    Route::get('references_still_open_after_forty_eight_hours_report','ReferenceController@referencesStillOpenAfterFortyEightHoursReport')->name('references_still_open_after_forty_eight_hours_report');
    
//Indexations
    Route::resource('indexations', 'IndexationController');
    Route::get('indexations_search/{keyword}', 'IndexationController@search')->name('indexations_search');
    Route::get('remove_the_indexation_file/{project_image_id}', 'IndexationController@removeIndexationFile')->name('remove_the_indexation_file');
    Route::get('indexation_form_part_search/{keyword}', 'IndexationController@indexationFormPartSearch')->name('indexation_form_part_search');
    Route::get('create_indexations_with_visit_id/{visit_id}', 'IndexationController@createIndexationWithVisitId')->name('create_indexations_with_visit_id');
    Route::get('get_indexations_released_in_specific_period_report', 'IndexationController@getIndexationsReleasedInSpecificPeriodReport')->name('get_indexation_released_in_specific_period_report');
    Route::get('indexations_released_in_specific_period_report_search/{from}/{to}', 'IndexationController@indexationsReleasedInSpecificPeriodReportSearch')->name('indexation_released_in_specific_period_report_search');
    Route::get('indexation_pm_ajax_search/{keyword}', 'IndexationController@ajaxSearchingOnPrintingMachine')->name('indexation_pm_ajax_search');
    
//Employees
    Route::resource('employees', 'EmployeeController');
    Route::get('employees_search/{keyword}', 'EmployeeController@search')->name('employees_search');
    Route::get('employees_pm_search/{keyword}', 'EmployeeController@searchingOnPrintingMachine')->name('employees_pm_search');
    Route::get('responsible_employees_for_invoices_not_paid_report', 'EmployeeController@getResponsibleEmployeesForInvoicesNotPaidReport')->name('responsible_employees_for_invoices_not_paid_report');
    
//DataEntry
    Route::get('import', 'DataEntryController@import');
