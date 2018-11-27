<?php
namespace App\AOE\Repositories\PrintingMachine;

use App\PrintingMachine;
use Illuminate\Support\Facades\Auth;
use App\Employee;

class EloquentPrintingMachine implements PrintingMachineInterface
{
    private $printingMachine;

    public function __construct(PrintingMachine $model)
    {
        $this->printingMachine = $model;
    }

    public function getAll()
    {
        return $this->printingMachine->all();
    }

	public function latest()
	{
		return $this->printingMachine->with('assignedEmployees.user')->latest();
	}

	public function oldest()
	{
		return $this->printingMachine->oldest();
	}

    public function getById($id)
    {
        return $this->printingMachine->findOrFail($id);
    }

    public function create(array $attributes)
    {
        $printingMachine = $this->printingMachine->create($attributes);
        $code = $this->setCustomCode($printingMachine);
        $printingMachine->code = $code;
        $printingMachine->save();
        return $printingMachine;
    }

    public function update($id, array $attributes)
    {
        $printingMachine = $this->printingMachine->findOrFail($id);
        $attributes['code'] = $this->setCustomCode($printingMachine);
        $printingMachine->update($attributes);
        return $printingMachine;
    }

    public function delete($id)
    {
        $this->printingMachine->findOrFail($id)->delete($id);
        return true;
    }

    public function search($keyword)
    {
        $results = $this->printingMachine->with('customer', 'assignedEmployees.user')
                            ->where('serial_number', 'like', "%$keyword%")
                            ->OrWhere('folder_number', 'like', "%$keyword%")
                            ->orWhere('code', 'like', "%$keyword%")
                            ->orWhere('status', 'like', "%$keyword%")
                            ->orWhere('model_prefix', 'like', "%$keyword%")
                            ->orWhere('model_suffix', 'like', "%$keyword%")
                            ->orWhereHas('customer', function($query) use($keyword){
                                $query->where('name', 'like', '%'.$keyword.'%');
                            })
                            ->orWhereHas('assignedEmployees', function($query2)use($keyword){
                                $query2->whereHas('user', function($query3)use($keyword){
                                    $query3->where('name', 'like', '%'.$keyword.'%');
                                });
                            })
                            ->get();
        return $results;
    }

    public function searchLimitedCodeCustomer($keyword)
    {
        $results = $this->printingMachine->with('customer', 'assignedEmployees.user')
							->where('code', 'like', "%$keyword%")
							->orWhere('serial_number', 'like', "%$keyword%")
                            ->orWhereHas('customer', function($query) use($keyword){
                                $query->where('name', 'like', '%'.$keyword.'%');
                            })
                            ->limit(150)
                            ->get();
        return $results;
    }

	public function searchingOnPrintingMachinesByCustomerName($keyword)
    {
        $results = $this->printingMachine->with('customer')
                            ->orWhereHas('customer', function($query) use($keyword){
                                $query->where('name', 'like', '%'.$keyword.'%');
                            })
                            ->limit(150)
                            ->get();
        return $results;
    }

    private function setCustomCode(PrintingMachine $printingMachine)
    {
        if ( isset($printingMachine->customer) && !empty($printingMachine->customer->code) ) {
            $customerCode = $printingMachine->customer->code;
            $customerCode .= '-'.$printingMachine->id;
            return $customerCode;
        }
    }

    public function getAllPrintingMachinesAsExcel()
    {
        $printingMachines = $this->printingMachine->with('customer','assignedEmployees.user')->get();
        foreach($printingMachines as $pm) {

            $manipulate[] = [
                            'رقم ملف الآلة'=>$pm->folder_number,
                            'الرقم المسلسل' =>$pm->serial_number,
                            'كود الآلة' =>$pm->code,
                            'الموديل' =>$pm->model_prefix.$pm->model_suffix,
                            'اسم العميل' => isset($pm->customer)?($pm->customer->name):(''),
                            'الإدارة' => isset($pm->customer)?($pm->customer->administration):(''),
                        ];
        }
       
        \Excel::create('كل الآلات - '.now(), function($excel) use($manipulate) {

            $excel->sheet('كل الآلات', function($sheet) use($manipulate) {
        
                $sheet->fromArray($manipulate);
        
            });
        
        })->download('xls');
    }

    public function getPrintingMachinesWithoutFollowUpCardsReport()
    {
        $printingMachinesWhithoutFollowUpCards = $this->printingMachine->whereDoesntHave('followUpcards')->get();
        return $printingMachinesWhithoutFollowUpCards;
    }

    /**
     * Get the employee from authenticated user.
     *
     * @return Employee
     */
    public function getAuthenticatedEmployee():Employee
    {
        $authUser = Auth::user();
        $authEmployee = (isset($authUser->employee))?($authUser->employee):(new Employee());
        return $authEmployee;
    }

}
