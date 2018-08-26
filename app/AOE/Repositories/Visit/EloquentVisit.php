<?php

namespace App\AOE\Repositories\Visit;

use App\Visit;
use App\ReadingOfPrintingMachine;

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
                            ->orWhere('serial_number', 'like', '%'.$keyword.'%');
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
}
