<?php

use App\PrintingMachine;
use Illuminate\Database\Seeder;

class PrintingMachinesOutOfService extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::load('/public/excel/printing_machines_out_of_service.xlsx', 
                    function($reader)
                    {
                        $results = $reader->takeRows(1)->get();
                        foreach ($results as $row) {
                            $folderNumber   = $row->folder_number;
                            $modelSuffex    = $row->model_suffix;
                            $modlePrefix    = $row->model_prefix;
                            $serialNumber   = $row->serial_number;
                            $customerName   = $row->customer_name;
                            $administration = $row->administration;

                            $printingMachine = PrintingMachine::where('folder_number', $folderNumber)->get();

                            //if printing machine is not exist
                            if (!$printingMachine->count()) {
                                dd($printingMachine);

                            }
                                // check customer is exist
                            $customer;


                        }
                    });
    }
}