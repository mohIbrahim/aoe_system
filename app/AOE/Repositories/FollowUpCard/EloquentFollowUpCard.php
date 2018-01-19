<?php

namespace App\AOE\Repositories\FollowUpCard;

use App\FollowUpCard;

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
        $followUpCards = $this->followUpCard->latest();
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
        return $followUpCard;
    }
    public function update($id, array $attributes)
    {
        $followUpCard = $this->followUpCard->findOrFail($id);
        $followUpCard->update($attributes);
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
        $results = $this->followUpCard->where('code', 'like', '%'.$keyword.'%')
                        ->get();
        return $results;
    }
}
