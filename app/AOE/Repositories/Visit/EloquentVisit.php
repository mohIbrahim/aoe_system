<?php

namespace App\AOE\Repositories\Visit;

use App\Visit;
use App\ReadingOfPrintingMachine;
use Maatwebsite\Excel\Excel;

class EloquentVisit implements VisitInterface
{
    private $visit;

    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }
    public function getAll()
    {
        $visits = $this->visit->all();
        return $visits;
    }
    public function latest()
    {
        $visits = $this->visit->latest();
        return $visits;
    }
    public function oldest()
    {
        $visits = $this->visit->oldest();
        return $visits;
    }
    public function getById($id)
    {
        $visit = $this->visit->findOrFail($id);
        return $visit;
    }
    public function create(array $attributes)
    {
        $visit = $this->visit->create($attributes);
        if($visit->readings_of_printing_machine) {
            $visit->readingOfPrintingMachine()->create(['value'=>$visit->readings_of_printing_machine, 'reading_date'=>$visit->visit_date, 'printing_machine_id'=>$visit->printing_machine_id]);
        }
        return $visit;
    }
    public function update($id, array $attributes)
    {
        $visit = $this->visit->findOrFail($id);
        $visit->update($attributes);
        $read               = $visit->readingOfPrintingMachine;
        if($read) {
            $read->value = $visit->readings_of_printing_machine;
            $read->reading_date = isset($read->value)?$visit->visit_date:null;
            $read->printing_machine_id = $visit->printing_machine_id;
            $visit->readingOfPrintingMachine()->update($read->toArray());

        }else {
            $visit->readingOfPrintingMachine()->create(['value'=>$visit->readings_of_printing_machine, 'reading_date'=>$visit->visit_date, 'printing_machine_id'=>$visit->printing_machine_id]);
        }

        return $visit;
    }
    public function delete($id)
    {
        $visit = $this->visit->findOrFail($id);
        $isDeleted = $visit->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->visit->with('printingMachine', 'theEmployeeWhoMadeTheVisit.user')
                        ->whereBetween('visit_date', [$keyword.' 00:00:00', $keyword.' 23:59:59'])
                        ->orWhere('id', 'like', '%'.$keyword.'%')
                        ->orWhere('type', 'like', '%'.$keyword.'%')
                        ->orWhereHas('printingMachine', function($query)use($keyword){
                            $query->where('code', 'like', '%'.$keyword.'%')
                            ->orWhere('serial_number', 'like', '%'.$keyword.'%')
                            ->orWhere('folder_number', 'like', '%'.$keyword.'%');
                        })
                        ->orWhereHas('theEmployeeWhoMadeTheVisit', function($query) use($keyword){
                            $query->whereHas('user', function($query2) use($keyword){
                                $query2->where('name', 'like', '%'.$keyword.'%');
                            });
                        })
                        ->get();
        return $results;
    }

    public function getVisitsInSpecificPeriodReport($from, $to)
    {
        return $this->visit->with('printingMachine', 'theEmployeeWhoMadeTheVisit.user')->whereBetween('visit_date', [$from, $to])->get();
    }

    /**
     * Getting all visits as excel sheet
     */
    public function getAllVisitsAsExcel()
    {
        $visits = $this->visit->with('printingMachine','theEmployeeWhoMadeTheVisit')->get();
        foreach($visits as $visit) {

            $manipulate[] = [
                            'رقم الزيارة' =>$visit->id,
                            'تاريخ الزيارة' =>$visit->visit_date,
                            'نوع الزيارة' =>$visit->type,
                            'رقم ملف الآلة' =>$visit->printingMachine->folder_number,
                            'كود آلة التصوير' => $visit->printingMachine->code,
                            'سيريل آلة التصوير' => $visit->printingMachine->serial_number,
                            'قراءة العداد' => $visit->readings_of_printing_machine,
                            'اسم المهندس الذي قام بالزيارة' => $visit->theEmployeeWhoMadeTheVisit->employee_name,
                        ];
        }
       
        Excel::create('كل الزيارات - '.now(), function($excel) use($manipulate) {

            $excel->sheet('كل الزيارات', function($sheet) use($manipulate) {
        
                $sheet->fromArray($manipulate);
        
            });
        
        })->download('xls');
    }
}
