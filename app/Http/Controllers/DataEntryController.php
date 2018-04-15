<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use App\Employee;

class DataEntryController extends Controller
{
    public function import()
    {
        $this->createEmployees();
    }

    private function createEmployees()
    {
        \Excel::load('excel/warranty.xlsx', function($reader) {

            $results = $reader->get();
            dd($reader->takeRows(10)->get()->toArray());
            foreach ($results as $row)
            {
                $username = $row->engineer;                
                User::create([
                            'name'=>trim($username),
                            'email'=>str_slug(trim($username), '-').'@aoe-system.com',
                            'password'=>str_random(8),
                            ]);
            }
            return redirect()->home();
        });
    }
}
