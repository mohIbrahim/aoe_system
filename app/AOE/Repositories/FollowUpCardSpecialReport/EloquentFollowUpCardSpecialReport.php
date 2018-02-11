<?php

namespace App\AOE\Repositories\FollowUpCardSpecialReport;

use App\FollowUpCardSpecialReport;

class EloquentFollowUpCardSpecialReport implements FollowUpCardSpecialReportInterface
{
    private $followUpCardSpecialReport;

    public function __construct(FollowUpCardSpecialReport $followUpCardSpecialReport)
    {
        $this->followUpCardSpecialReport = $followUpCardSpecialReport;
    }
    public function getAll()
    {
        $followUpCardSpecialReports = $this->followUpCardSpecialReport->all();
        return $followUpCardSpecialReports;
    }
    public function latest()
    {
        $followUpCardSpecialReports = $this->followUpCardSpecialReport->latest();
        return $followUpCardSpecialReports;
    }
    public function oldest()
    {
        $followUpCardSpecialReports = $this->followUpCardSpecialReport->oldest();
        return $followUpCardSpecialReports;
    }
    public function getById($id)
    {
        $followUpCardSpecialReport = $this->followUpCardSpecialReport->findOrFail($id);
        return $followUpCardSpecialReport;
    }
    public function create(array $attributes)
    {
        $followUpCardSpecialReport = $this->followUpCardSpecialReport->create($attributes);
        return $followUpCardSpecialReport;
    }
    public function update($id, array $attributes)
    {
        $followUpCardSpecialReport = $this->followUpCardSpecialReport->findOrFail($id);
        $followUpCardSpecialReport->update($attributes);
        return $followUpCardSpecialReport;
    }
    public function delete($id)
    {
        $followUpCardSpecialReport = $this->followUpCardSpecialReport->findOrFail($id);
        $isDeleted = $followUpCardSpecialReport->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->followUpCardSpecialReport->where('the_date', 'like', '%'.$keyword.'%')
                                                    ->orWhere('id', 'like', '%'.$keyword.'%')
                                                    ->orWhere('readings_of_printing_machine', 'like', '%'.$keyword.'%')
                                                    ->orWhere('indexation_number', 'like', '%'.$keyword.'%')
                                                    ->orWhere('invoice_number', 'like', '%'.$keyword.'%')
                                                    ->get();
        return $results;
    }

}
