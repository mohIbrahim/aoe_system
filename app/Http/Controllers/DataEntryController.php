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

class DataEntryController extends Controller
{
    public function import()
    {
        $this->createEmployees();
    }

    private function createEmployees()
    {
        \Excel::load('excel/warranty.xlsx', function($reader) {

            $results = $reader->takeRows(256)->get();
            foreach ($results as $row)
            {
                //Employee
                $username = $row->engineer;
                $user = null;
                $employee = null;
                if (!empty($username)) {
                    if (User::where('name', 'like', $username)->get()->isEmpty()) {
                        $user = User::create([
                                            'name'=>trim($username),
                                            'email'=>str_slug(trim($username), '-').'@aoe-system.com',
                                            'password'=>str_random(8),
                                            ]);
                        $employee = $user->employee()->create(['job_title'=>'مهندس صيانة']);
                    }
                }

                //Customer, Printing machine, Contract
                $eloquentCustomer = new EloquentCustomer(new Customer());
                $customerBranch         = null;
                $customerMain           = null;
                $phone1                 = $row->phone1;
                $phone2                 = $row->phone2;
                $phone3                 = $row->phone3;
                $responsiblePersoneName = $row->responsible_persone_name;
                $fax                    = $row->fax;
                $email                  = $row->email;
                $customerName           = $row->name;
                $administration         = $row->administration;
                $sector                 = $row->sector;
                $type                   = $row->type;
                $accountantName         = $row->accountant_name;
                $governorate            = $row->governorate;
                $area                   = $row->area;
                $address                = $row->address;

                $folderNumber           = $row->folder_number;
                $modelPrefix            = $row->model_prefix;
                $modelSuffix            = $row->model_suffix;
                $serialNumber           = $row->serial_number;

                $contractStart          = $row->warranty_start;
                $contractEnd            = $row->warranty_end;
                

                if (!empty($customerName)) {
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
                        $contract = $this->createContract($contractStart, $contractEnd);
                        $pm->contracts()->attach([$contract->id]);
                        $employee->assignedPrintingMachines()->attach($pm->id);
                        
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
                            $contract = $this->createContract($contractStart, $contractEnd);
                            $pm->contracts()->attach([$contract->id]);
                            $employee->assignedPrintingMachines()->attach($pm->id);
                        }
                    }
                }

                //Printing Machine




            }
            return redirect()->home();
        });
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

    private function createContract($start, $end)
    {
        $eloquentContract = new EloquentContract(new Contract());
        $contract = $eloquentContract->create([
                                            'type'=>'ضمان', 
                                            'start'=>$start, 
                                            'end'=>$end, 
                                            'status'=>'ساري', 
                                            'payment_system'=>'بدون',
                                        ]);
        return $contract;
    }
}
