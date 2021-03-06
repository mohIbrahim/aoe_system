<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\Permission;

class DeveloperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
    	$moh = new User();    	
    	$moh->name = "Mohammed Ibrahim Fawzy";
    	$moh->email = "mohibrahimqop@gmail.com";
    	$moh->password = bcrypt("123456789");
		$moh->save();
		
		$joh = new User();
		$joh->name = 'John Sameh';
		$joh->email = 'j.sameh@infomed-me.com';
		$joh->password = bcrypt('J12341234');
		$joh->save();

    	$role = new Role();
    	$role->name = "Developer";
    	$role->save();

		$moh->roles()->attach($role);
		$joh->roles()->attach($role);
		
    	$permissions = Permission::all();

    	foreach ($permissions as $permission) {
    		$role->permissions()->attach($permission);
    	}        
    }
}
