<?php

namespace App\AOE\JobTitle;

class JobTitle
{
    private $jobTitle = [
        'مهندس صيانة'=>'مهندس صيانة',
        'موزع'=>'موزع',
        'سكرتارية'=>'سكرتارية',
    ];

    public function getJobTitle()
    {
        return $this->jobTitle;
    }
}
