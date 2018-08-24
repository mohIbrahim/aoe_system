<?php
namespace App\AOE\Repositories\PartSerialNumber;


use App\PartSerialNumber;

class EloquentPartSerialNumber implements PartSerialNumberInterface
{
    private $partSerialNumber;

    public function __construct(PartSerialNumber $partSerialNumber)
    {
        $this->partSerialNumber = $partSerialNumber;
    }

    public function getAll()
    {
        $partSerialNumbers = $this->partSerialNumber->all();
        return $partSerialNumbers;
    }


    public function getById($id)
    {
        $partSerialNumber = $this->partSerialNumber->findOrFail($id);
        return $partSerialNumber;
    }


    public function latest()
    {
        $partSerialNumbers = $this->partSerialNumber->latest();
        return $partSerialNumbers;
    }

    public function oldest()
    {
        $partSerialNumbers = $this->partSerialNumber->oldest();
        return $partSerialNumbers;
    }


    public function create(array $attributes)
    {
        $partSerialNumber = $this->partSerialNumber->create($attributes);
        return $partSerialNumber;
    }


    public function update($id, array $attributes)
    {
        $partSerialNumber = $this->partSerialNumber->findOrFail($id);
        $isUpdated = $partSerialNumber->update($attributes);
        return $isUpdated;
    }


    public function delete($id)
    {
        $partSerialNumber = $this->partSerialNumber->findOrFail($id);
        $isDeleted = $partSerialNumber->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->partSerialNumber->with('part')
                                            ->where('serial_number', 'like', '%'.$keyword.'%')
                                            ->orWhere('code', 'like', '%'.$keyword.'%')
                                            ->orWhere('availability', 'like', '%'.$keyword.'%')
                                            ->orWhere('status', 'like', '%'.$keyword.'%')
                                            ->orWhere('date_of_entry', 'like', '%'.$keyword.'%')
                                            ->orWhere('date_of_departure', 'like', '%'.$keyword.'%')
                                            ->orWhereHas('part', function($query) use($keyword){
                                                $query->where('name', 'like', "%$keyword");
                                            })
                                            ->get();
        return $results;

    }
}
