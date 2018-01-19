<?php
namespace App\AOE\Repositories\FollowUpCard;

interface FollowUpCardInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}
