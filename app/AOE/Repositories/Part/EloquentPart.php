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
}
