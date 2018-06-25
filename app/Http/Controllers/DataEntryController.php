<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\AOE\Repositories\Customer\EloquentCustomer;
use App\PrintingMachine;
use App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;
use App\Contract;
use App\AOE\Repositories\Contract\EloquentContract;
use App\Employee;
use App\Part;
use App\Department;
use \Carbon\Carbon;

class DataEntryController extends Controller
{
    public function import()
    {
        //$this->importAOEData();
        $isDone = $this->importWarrntySheet();
        dd($isDone);
        return null;
    }

    private function importWarrntySheet()
    {
        \Excel::load('excel/warranty2.xlsx', function($reader) {
            $results = $reader->takeRows(1741)->get();
            foreach ($results as $row)
            {
                //Employee
                $username = $row->engineer;
                $user = null;
                $employee = null;
                if (!empty($username)) {
                    if (User::where('name', $username)->get()->isEmpty()) {
                        $user = User::create([
                                            'name'=>trim($username),
                                            'email'=>str_slug(trim($username), '-').'@aoe-egypt.com',
                                            'password'=>bcrypt(str_random(8)),
                                            ]);
                        $employee = $user->employee()->create(['job_title'=>'مهندس صيانة']);
                    }
                }

                //Customer, Printing machine, Contract
                $eloquentCustomer         = new EloquentCustomer(new Customer());
                $customerBranch           = null;
                $customerMain             = null;
        
                $phone1                   = $row->phone1;
                $phone2                   = $row->phone2;
                $phone3                   = $row->phone3;
                $responsiblePersoneName   = $row->responsible_persone_name;
                $fax                      = $row->fax;
                $email                    = $row->email;
                $customerName             = $row->name;
                $administration           = $row->administration;
                $sector                   = $row->sector;
                $type                     = $row->type;
                $accountantName           = $row->accountant_name;
                $governorate              = $row->governorate;
                $area                     = $row->area;
                $address                  = $row->address;
        
                $folderNumber             = $row->folder_number;
                $modelPrefix              = $row->model_prefix;
                $modelSuffix              = $row->model_suffix;
                $serialNumber             = $row->serial_number;
        
                $contracType              = $row->contract_type;
                $warrantyStart            = $row->warranty_start;
                $warrantyEnd              = $row->warranty_end;
                $maintenanceStart         = $row->maintenance_start;
                $maintenanceEnd           = $row->maintenance_end;
                $priceBeforeTax           = $row->price_before_tax;
                $priceAfterTax            = $row->price_after_tax;
                $paymentSystem            = $row->payment_system;
                $periodBetweenEachPayment = $row->period_between_each_payment;
                $contractComments         = $row->contract_comments;
                $contractComments2        = $row->contract_comments2;
                $contractComments3        = $row->contract_comments3;
        
                $invoiceOneReleaseDate    = $row->invoice_1_release_date;
                $invoiceOneNumber         = $row->invoice_1_number;
                $invoiceOnePrice          = $row->invoice_1_price;
        
                $invoiceTwoReleaseDate    = $row->invoice_2_release_date;
                $invoiceTwoNumber         = $row->invoice_2_number;
                $invoiceTwoPrice          = $row->invoice_2_price;
                
                $invoiceThreeReleaseDate  = $row->invoice_3_release_date;
                $invoiceThreeNumber       = $row->invoice_3_number;
                $invoiceThreePrice        = $row->invoice_3_price;
                
                $invoiceFourReleaseDate   = $row->invoice_4_release_date;
                $invoiceFourNumber        = $row->invoice_4_number;
                $invoiceFourPrice         = $row->invoice_4_price;


                if (!empty($customerName)) {
                    $empId = User::where('name', 'like', $username )->get()->first()->employee->id;
                    if (Customer::where('name', 'like', $customerName)->get()->isEmpty()) {
                        //main
                        $customerMain =   $eloquentCustomer->create([
                                                                'sector'=> $sector,
                                                                'name' => $customerName,
                                                                'type' => $type,
                                                                'email' => $email,
                                                                'responsible_person_name' => $responsiblePersoneName,
                                                                'address' => $address,
                                                                'area' => $area,
                                                                'city' => $governorate,
                                                                'governorate' => $governorate,
                                                                'administration' => $administration,
                                                                'comments' => 'رقم الفكس: '.$fax,
                                                                'accounts_dep_emp_name' => $accountantName,
                                                                'telecom'=>[$phone1, $phone2, $phone3],
                                                            ]);
                        $pm = $this->createPrintingMachine($folderNumber, $modelPrefix, $modelSuffix, $serialNumber, $customerMain->id);

                        $contract = $this->createContractsAndTheirOwnInvoices($pm->id, $serialNumber, $contracType, $warrantyStart, $warrantyEnd, $maintenanceStart, $maintenanceEnd, $priceBeforeTax, $priceAfterTax, $paymentSystem, $periodBetweenEachPayment, $contractComments, $contractComments2, $contractComments3,  $invoiceOneReleaseDate, $invoiceOneNumber, $invoiceOnePrice, $invoiceTwoReleaseDate, $invoiceTwoNumber, $invoiceTwoPrice,  $invoiceThreeReleaseDate, $invoiceThreeNumber, $invoiceThreePrice, $invoiceFourReleaseDate, $invoiceFourNumber, $invoiceFourPrice, $customerMain->id);

                        
                        $pm->assignedEmployees()->attach($empId);
                        
                    } else {
                        //brach
                        $main = Customer::where('name', 'like', $customerName)->where('main_branch_id', null)->get()->first();
                        if (!empty($main->id)) {
                            $customerBranch =   $eloquentCustomer->create([
                                                                'sector'=> $sector,
                                                                'name' => $customerName.'-'.$governorate.'-'.$area,
                                                                'type' => $type,
                                                                'email' => $email,
                                                                'responsible_person_name' => $responsiblePersoneName,
                                                                'address' => $address,
                                                                'area' => $area,
                                                                'city' => $governorate,
                                                                'governorate' => $governorate,
                                                                'administration' => $administration,
                                                                'comments' => 'رقم الفكس: '.$fax,
                                                                'main_branch_id' =>$main->id,
                                                                'accounts_dep_emp_name' => $accountantName,
                                                                'telecom'=>[$phone1, $phone2, $phone3],
                                                            ]);
                            $pm = $this->createPrintingMachine($folderNumber, $modelPrefix, $modelSuffix, $serialNumber, $customerBranch->id);

                            $contract = $this->createContractsAndTheirOwnInvoices($pm->id, $serialNumber, $contracType, $warrantyStart, $warrantyEnd, $maintenanceStart, $maintenanceEnd, $priceBeforeTax, $priceAfterTax, $paymentSystem, $periodBetweenEachPayment, $contractComments, $contractComments2, $contractComments3,  $invoiceOneReleaseDate, $invoiceOneNumber, $invoiceOnePrice, $invoiceTwoReleaseDate, $invoiceTwoNumber, $invoiceTwoPrice,  $invoiceThreeReleaseDate, $invoiceThreeNumber, $invoiceThreePrice, $invoiceFourReleaseDate, $invoiceFourNumber, $invoiceFourPrice, $customerBranch->id);

                            
                            $pm->assignedEmployees()->attach($empId);
                        }
                    }
                }




            }      
        });        
        return "Done";
    }

    private function createPrintingMachine($folderNumber, $modelPrefix, $modelSuffix, $serialNumber, $customerId)
    {
        $eloquentPrintingMachine = new EloquentPrintingMachine(new PrintingMachine());
        $printingMachine = $eloquentPrintingMachine->create([            
                                                        'folder_number'=>$folderNumber,
                                                        'status'=>'فعالة',
                                                        'the_manufacture_company'=>'Sharp',
                                                        'model_prefix'=>$modelPrefix,
                                                        'model_suffix'=>$modelSuffix,
                                                        'serial_number'=>$serialNumber,
                                                        'is_sold_by_aoe'=>1,
                                                        'customer_id'=>$customerId,
                                                    ]);
            return $printingMachine;
    }

    private function createContractsAndTheirOwnInvoices($printingMachineId, $printingMachineSerialNumber, $contracType, $warrantyStart, $warrantyEnd, $maintenanceStart, $maintenanceEnd, $priceBeforeTax, $priceAfterTax, $paymentSystem, $periodBetweenEachPayment, $contractComments, $contractComments2, $contractComments3, $invoiceOneReleaseDate, $invoiceOneNumber, $invoiceOnePrice, $invoiceTwoReleaseDate, $invoiceTwoNumber, $invoiceTwoPrice,  $invoiceThreeReleaseDate, $invoiceThreeNumber, $invoiceThreePrice, $invoiceFourReleaseDate, $invoiceFourNumber, $invoiceFourPrice, $customerId)
    {
        if($periodBetweenEachPayment == 'يوجد موافقة عقد')
                dd($printingMachineSerialNumber);
        $eloquentContract = new EloquentContract(new Contract());
        if ( $contracType == 'ضمان' ) {
            if ( !empty($warrantyStart) && !empty($warrantyEnd) ) {
                $contract = $eloquentContract->create([
                                                        'type'=>'ضمان', 
                                                        'start'=>$warrantyStart, 
                                                        'end'=>$warrantyEnd, 
                                                        'status'=>( (((new Carbon())->parse($warrantyEnd))->gte(Carbon::now()) )?('ساري'):('منتهي') ), 
                                                        'payment_system'=>'بدون',
                                                        'comments'=>$contractComments.'&#13;&#10;'.$contractComments2.'&#13;&#10;'.$contractComments3,
                                                    ]);
                $contract->printingMachines()->attach($printingMachineId);
            }
        } else {
            if ( !empty($warrantyStart) && !empty($warrantyEnd) ) {
                $contract = $eloquentContract->create([
                                                        'type'=>'ضمان', 
                                                        'start'=>$warrantyStart, 
                                                        'end'=>$warrantyEnd, 
                                                        'status'=>( (((new Carbon())->parse($warrantyEnd))->gte(Carbon::now()) )?('ساري'):('منتهي') ), 
                                                        'payment_system'=>'بدون',
                                                        'comments'=>$contractComments.'&#13;&#10;'.$contractComments2.'&#13;&#10;'.$contractComments3,
                                                    ]);
                $contract->printingMachines()->attach($printingMachineId);
            }
            $contract = $eloquentContract->create([
                                                    'type'=>$contracType,
                                                    'start'=> ((new Carbon())->parse($maintenanceEnd)->subYear()),
                                                    'end'=>$maintenanceEnd,
                                                    'status'=>( (((new Carbon())->parse($maintenanceEnd))->gte(Carbon::now()) )?('ساري'):('منتهي') ),
                                                    'price'=>$priceBeforeTax,
                                                    'tax'=>14,
                                                    'total_price'=>$priceAfterTax,
                                                    'payment_system'=>$paymentSystem,
                                                    'period_between_each_payment'=>$periodBetweenEachPayment,
                                                    'comments'=>$contractComments.'&#13;&#10;'.$contractComments2.'&#13;&#10;'.$contractComments3,
                                                ]);

            $contract->printingMachines()->attach($printingMachineId);
            $eloquentContract->createInvoicesForNewContract($contract);

            $contractInvoices = $contract->invoices;
            foreach ($contractInvoices as $invoiceKey=>$invoice) {
                if ($invoiceKey == 0)
                    $invoice->update(['customer_id'=>$customerId, 
                                    'release_date'=>$invoiceOneReleaseDate,
                                    'number'=>$invoiceOneNumber,
                                    'total'=>$invoiceOnePrice
                                    ]);
                if ($invoiceKey == 1)
                    $invoice->update(['customer_id'=>$customerId, 
                                    'release_date'=>$invoiceTwoReleaseDate,
                                    'number'=>$invoiceTwoNumber,
                                    'total'=>$invoiceTwoPrice
                                    ]);
                if ($invoiceKey == 2)
                    $invoice->update(['customer_id'=>$customerId, 
                                    'release_date'=>$invoiceThreeReleaseDate,
                                    'number'=>$invoiceThreeNumber,
                                    'total'=>$invoiceThreePrice
                                    ]);
                if ($invoiceKey == 3)
                    $invoice->update(['customer_id'=>$customerId, 
                                    'release_date'=>$invoiceFourReleaseDate,
                                    'number'=>$invoiceFourNumber,
                                    'total'=>$invoiceFourPrice
                                    ]);
            }
        }
        return $contract;
    }


    public function importSparePartSheet()
    {
        \Excel::load('excel/SPARE_PARTS_.xls', function($reader) {

            $results = $reader->takeRows(1402)->get();
            
            foreach ($results as $row ) {
                $partName           = $row->name;
                $partCode           = $row->code;
                $partDescription    = $row->descriptions;
                $partQty            = $row->qty;
                $partPrice          = $row->price_without;
                $partNumber         = $row->part_number;
                $locaton            = $row->location;
                
                $part = Part::create([
                                        'code' => $partCode, 
                                        'name' => $partName, 
                                        'type' => 'قطعة غيار', 
                                        'descriptions' => $partDescription, 
                                        'is_serialized' => 0, 
                                        'location_in_warehouse' => $locaton, 
                                        'part_number' => $partNumber, 
                                        'price_without_tax' => $partPrice, 
                                        'no_serial_qty' => $partQty, 
                                    ]);
            }
           
        });
        return null;
    }

    public function importConsumableSheet()
    {
        \Excel::load('excel/SAMPLE_PRICE_JOHN_MAR12.xlsx', function($reader) {

            $results = $reader->takeRows(136)->get();
            
            foreach ($results as $row ) {
                $partName                   = $row->name;
                $partCode                   = $row->code;
                $partDescription            = $row->description;
                $compatablePrintingMachines = $row->compatable_machine;
                $life                       = $row->life;
                $partPrice                  = $row->price_without;
                
                $part = Part::create([
                                    'name' => $partName.'-'.$partCode, 
                                    'code' => $partCode, 
                                    'descriptions' => $partDescription,
                                    'compatible_printing_machines' => $compatablePrintingMachines, 
                                    'life' => $life, 
                                    'price_without_tax' => $partPrice, 
                                    'type' => 'مستهلكات',
                                    'is_serialized' => 1,
                                ]);
            }
           
        });
        return null;
    }

    public function importAOEData()
    {
        \Excel::load('excel/aoe_data.xlsx', function($reader) {
            $results = $reader->takeRows(24)->get();
            Department::create(['name'=>'الادارة']);
            Department::create(['name'=>'سكرتارية']);
            Department::create(['name'=>'ما بعد البيع']);
            foreach ($results as $row) {

                $name = trim($row->name);
                $jobTitle = trim($row->job_title);
                $phone = trim($row->phone);
                $email = trim($row->email);
                $department = trim($row->department);
                $password = trim($row->pass);

                if (!empty($name)) {
                    if (User::where('name', 'like', $name)->get()->isEmpty()) {
                        $user = User::create([
                                            'name'=>trim($name),
                                            'email'=>((!empty($email))?($email):(str_slug(trim($name), '-').'@aoe-egypt.com')),
                                            'password'=>bcrypt($password),
                                            ]);
                        $departmentId = Department::where('name', $department)->get()->first()->id;
                        $employee = $user->employee()->create([
                                                            'job_title'=>$jobTitle, 
                                                            'comments'=>"رقم التليفون: $phone", 'department_id'=>$departmentId
                                                            ]);
                    }
                }
            }
        });
    }
}
