<?php
namespace App\AOE\Repositories\Part;

use App\Part;

class EloquentPart implements PartInterface
{
    private $part;

    public function __construct(Part $part)
    {
        $this->part = $part;
    }
    public function getAll()
    {
        $parts = $this->part->all();
        return $parts;
    }
    public function latest()
    {
        $parts = $this->part->latest();
        return $parts;
    }
    public function oldest()
    {
        $parts = $this->part->oldest();
        return $parts;
    }
    public function getById($id)
    {
        $part = $this->part->findOrFail($id);
        return $part;
    }
    public function create(array $attributes)
    {
        $part = $this->part->create($attributes);
        return $part;
    }
    public function update($id, array $attributes)
    {
        $part = $this->part->findOrFail($id);
        $part->update($attributes);
        return $part;
    }
    public function delete($id)
    {
        $part = $this->part->findOrFail($id);
        $isDeleted = $part->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results['parts'] = $this->part->where('code', 'like', '%'.$keyword.'%')
                                ->orWhere('name', 'like', '%'.$keyword.'%')
                                ->orWhere('code', 'like', '%'.$keyword.'%')
                                ->orWhere('part_number', 'like', '%'.$keyword.'%')
                                ->orWhere('type', 'like', '%'.$keyword.'%')
                                ->orWhere('compatible_printing_machines', 'like', '%'.$keyword.'%')
                                ->orWhere('qty', 'like', $keyword)
                                ->orWhere('no_serial_qty', 'like', $keyword)
                                ->get();
        $results['view_part_number'] = in_array('view_part_number', auth()->user()->getUserPermissions());
        return $results;
    }
}
