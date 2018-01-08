<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->permissions();
        $this->users();
        $this->roles();
		$this->printingMachines();
        $this->customers();
    }

    /**
     * Create permissions Privilages
     * @return void
     */
    private function permissions()
    {
        DB::table('permissions')->insert([
            "name"      =>"view_permissions",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"create_permissions",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"update_permissions",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"delete_permissions",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }
     /**
     * Create permissions Users
     * @return void
     */
     private function users()
     {
        DB::table('permissions')->insert([
            "name"      =>"view_users",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"create_users",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"update_users",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"delete_users",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    /**
     * Create permissions Roles
     * @return void
     */
    private function roles()
    {
        DB::table('permissions')->insert([
            "name"      =>"view_roles",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"create_roles",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"update_roles",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"delete_roles",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }


	/**
     * Create permissions Roles
     * @return void
     */
    private function printingMachines()
    {
        DB::table('permissions')->insert([
            "name"      =>"view_printing_machines",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"create_printing_machines",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"update_printing_machines",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"delete_printing_machines",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function customers()
    {
        DB::table('permissions')->insert([
            "name"      =>"view_customers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"create_customers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"update_customers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "name"      =>"delete_customers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

}
