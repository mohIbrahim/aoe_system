<?php

namespace App\AOE\JobTitle;

class JobTitle
{
    private $jobTitle = [
        'مهندس صيانة'=>'مهندس صيانة',
        'سكرتارية'=>'سكرتارية',
    ];

    public function getJobTitle()
    {
        return $this->jobTitle;
    }
}
