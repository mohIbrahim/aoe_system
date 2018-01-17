<?php

namespace App\AOE\Repositories\Visit;

use App\Visit;

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
        return $visit;
    }
    public function update($id, array $attributes)
    {
        $visit = $this->visit->findOrFail($id);
        $visit->update($attributes);
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
        $results = $this->visit->where('date', 'like', '%'.$keyword.'%')
                        ->get();
        return $results;
    }
}
