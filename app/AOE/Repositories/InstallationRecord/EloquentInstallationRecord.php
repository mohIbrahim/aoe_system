<?php

namespace App\AOE\Repositories\InstallationRecord;

use App\InstallationRecord;
use App\Contract;

class EloquentInstallationRecord implements InstallationRecordInterface
{
    private $installationRecord;

    /**
     * [__construct description]
     * @param InstallationRecord $installationRecord [description]
     */
    public function __construct(InstallationRecord $installationRecord)
    {
        $this->installationRecord = $installationRecord;
    }

    /**
     * [getAll description]
     * @return [type] [description]
     */
    public function getAll()
    {
        $installationRecords = $this->installationRecord->all();
        return $installationRecords;
    }

    /**
     * [latest description]
     * @return [type] [description]
     */
    public function latest()
    {
        $installationRecords = $this->installationRecord->latest();
        return $installationRecords;
    }

    /**
     * [oldest description]
     * @return [type] [description]
     */
    public function oldest()
    {
        $installationRecords = $this->installationRecord->oldest();
        return $installationRecords;
    }

    /**
     * [getById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getById($id)
    {
        $installationRecord = $this->installationRecord->findOrFail($id);
        return $installationRecord;
    }

    /**
     * [create description]
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function create(array $attributes)
    {
        $installationRecord = $this->installationRecord->create($attributes);        
        return $installationRecord;
    }

    /**
     * [update description]
     * @param  [type] $id         [description]
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function update($id, array $attributes)
    {
        $installationRecord = $this->installationRecord->findOrFail($id);
        $installationRecord->update($attributes);
        return $installationRecord;
    }

    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $installationRecord = $this->installationRecord->findOrFail($id);
        $isDeleted = $installationRecord->delete();
        return $isDeleted;
    }


    public function contractOfGuarantee()
    {
        return $contractsOfGuarantee = Contract::where('type','ضمان')->pluck('code', 'id');
    }

}
