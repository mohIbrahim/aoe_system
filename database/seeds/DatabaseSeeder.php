<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory('App\Contract', 50)->create();
        // factory('App\User', 50)->create();
        factory('App\PrintingMachine', 100)->create();
    }
}
