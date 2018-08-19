<?php

namespace App\AOE\Repositories\FollowUpCard;

use App\FollowUpCard;
use App\Contract;

class EloquentFollowUpCard implements FollowUpCardInterface
{
    private $followUpCard;

    public function __construct(FollowUpCard $followUpCard)
    {
        $this->followUpCard = $followUpCard;
    }
    public function getAll()
    {
        $followUpCards = $this->followUpCard->all();
        return $followUpCards;
    }
    public function latest()
    {
        $followUpCards = $this->followUpCard->with('printingMachine.customer')->latest();
        return $followUpCards;
    }
    public function oldest()
    {
        $followUpCards = $this->followUpCard->oldest();
        return $followUpCards;
    }
    public function getById($id)
    {
        $followUpCard = $this->followUpCard->findOrFail($id);
        return $followUpCard;
    }
    public function create(array $attributes)
    {
        $followUpCard = $this->followUpCard->create($attributes);
        $followUpCard = $this->specifyingFollowUpCardCode($followUpCard);
        return $followUpCard;
    }
    public function update($id, array $attributes)
    {
        $followUpCard = $this->followUpCard->findOrFail($id);
        $followUpCard->update($attributes);
        $followUpCard = $this->specifyingFollowUpCardCode($followUpCard);
        return $followUpCard;
    }
    public function delete($id)
    {
        $followUpCard = $this->followUpCard->findOrFail($id);
        $isDeleted = $followUpCard->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->followUpCard->with('printingMachine.customer', 'printingMachine.assignedEmployees.user','contract')
                                        ->where('code', 'like', '%'.$keyword.'%')
                                        ->orWhere('old_code', 'like', '%'.$keyword.'%')
                                        ->orWhereBetween('created_at', [$keyword.' 00:00:00', $keyword.' 23:59:59'])
                                        ->orWhereHas('contract', function($query) use($keyword)
                                            {
                                                $query->where('code', 'like', '%'.$keyword.'%');
                                            })
                                        ->orWhereHas('printingMachine', function($query)use($keyword)
                                            {
                                                $query->where('serial_number', 'like', "%$keyword%")
                                                        ->orWhereHas('customer', function($query)use($keyword)
                                                                                    {
                                                                                        $query->where('name', 'like', "%$keyword%");
                                                                                    })
                                                        ->orWhereHas('assignedEmployees', function($query)use($keyword)
                                                                                            {
                                                                                                $query->whereHas('user', function($query)use($keyword)
                                                                                                                            {
                                                                                                                                $query->where('name', 'like', "%$keyword%");
                                                                                                                            });
                                                                                            });
                                            })
                                        ->get();
        return $results;
    }

    public function contracts()
    {
        $contracts = Contract::all()->pluck('code', 'id');
        return $contracts;
    }

    public function visitsNotDoneOnTimeReport($period1, $period2)
    {
        $resultsArray = [];
        $selectedContract = \App\Contract::with('followUpCard')
                                        ->where('start', '<=', $period2)
                                        ->where('end', '>=', $period1)
                                        ->get();
        $intentedFollowUpCards = [];
        foreach ($selectedContract as $contract) {
            $followUpCard = $contract->followUpCard;
            if (isset($followUpCard)) {
                $visits = $followUpCard->visits()->whereBetween('visit_date', [$period1, $period2])->get();
                if ($visits->isEmpty()) {
                    $intentedFollowUpCards[] = $followUpCard;
                }
            }
        }

        foreach ($intentedFollowUpCards as $followUpCardIndex=>$intentedFollowUpCard) {
            $printingMachine = $intentedFollowUpCard->printingMachine;
            
            $resultsArray[$followUpCardIndex]['followUpCardId'] = $intentedFollowUpCard->id;
            $resultsArray[$followUpCardIndex]['followUpCardCode'] = $intentedFollowUpCard->code;
            $resultsArray[$followUpCardIndex]['printingMachineId'] = $printingMachine->id;
            $resultsArray[$followUpCardIndex]['printingMachineCode'] = $printingMachine->code;
            $resultsArray[$followUpCardIndex]['customerName'] = $printingMachine->customer->name;
            $resultsArray[$followUpCardIndex]['customerId'] = $printingMachine->customer->id;

            $assignedEmplyees = $printingMachine->assignedEmployees;
            $employeesNames = '';
            foreach ($assignedEmplyees as $employeeKey=>$employee) {
                $employeesNames .= (($employeeKey>0)?('-'):('')).$employee->user->name;
            }

            $resultsArray[$followUpCardIndex]['assignedEmployees'] = !empty($employeesNames)?($employeesNames):('لا يوجد موظفين معينين على هذة الآلة');
        }
        return $resultsArray; 
    }

    private function specifyingFollowUpCardCode(FollowUpCard $followUpCard)
    {
        if ($followUpCard) {
            $followUpCard->code = $followUpCard->id;
            $followUpCard->save();
        }
        return $followUpCard;
    }
}
