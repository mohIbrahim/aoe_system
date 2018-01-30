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
        $this->departments();
        $this->parts();
        $this->partSerialNumbers();
        $this->installationRecords();
        $this->contracts();
        $this->invoices();
        $this->visits();
        $this->followUpCards();
        $this->followUpCardSpecialReports();
        $this->references();
        $this->indexations();
        $this->employees();
    }

    /**
     * Create permissions Privilages
     * @return void
     */
    private function permissions()
    {
        DB::table('permissions')->insert([
            "title"      =>"permissions",
            "name"      =>"view_permissions",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"permissions",
            "name"      =>"create_permissions",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"permissions",
            "name"      =>"update_permissions",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"permissions",
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
            "title"      =>"users",
            "name"      =>"view_users",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"users",
            "name"      =>"create_users",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"users",
            "name"      =>"update_users",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"users",
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
            "title"      =>"roles",
            "name"      =>"view_roles",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"roles",
            "name"      =>"create_roles",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"roles",
            "name"      =>"update_roles",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"roles",
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
            "title"      =>"printing_machines",
            "name"      =>"view_printing_machines",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"printing_machines",
            "name"      =>"create_printing_machines",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"printing_machines",
            "name"      =>"update_printing_machines",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"printing_machines",
            "name"      =>"delete_printing_machines",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function customers()
    {
        DB::table('permissions')->insert([
            "title"      =>"customers",
            "name"      =>"view_customers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"customers",
            "name"      =>"create_customers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"customers",
            "name"      =>"update_customers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"customers",
            "name"      =>"delete_customers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function departments()
    {
        DB::table('permissions')->insert([
            "title"      =>"departments",
            "name"      =>"view_departments",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"departments",
            "name"      =>"create_departments",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"departments",
            "name"      =>"update_departments",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"departments",
            "name"      =>"delete_departments",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function parts()
    {
        DB::table('permissions')->insert([
            "title"      =>"parts",
            "name"      =>"view_parts",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"parts",
            "name"      =>"create_parts",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"parts",
            "name"      =>"update_parts",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"parts",
            "name"      =>"delete_parts",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function partSerialNumbers()
    {
        DB::table('permissions')->insert([
            "title"      =>"part_serial_numbers",
            "name"      =>"view_part_serial_numbers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"part_serial_numbers",
            "name"      =>"create_part_serial_numbers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"part_serial_numbers",
            "name"      =>"update_part_serial_numbers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"part_serial_numbers",
            "name"      =>"delete_part_serial_numbers",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function installationRecords()
    {
        DB::table('permissions')->insert([
            "title"      =>"installation_records",
            "name"      =>"view_installation_records",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"installation_records",
            "name"      =>"create_installation_records",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"installation_records",
            "name"      =>"update_installation_records",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"installation_records",
            "name"      =>"delete_installation_records",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }
    private function contracts()
    {
        DB::table('permissions')->insert([
            "title"      =>"contracts",
            "name"      =>"view_contracts",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"contracts",
            "name"      =>"create_contracts",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"contracts",
            "name"      =>"update_contracts",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"contracts",
            "name"      =>"delete_contracts",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function invoices()
    {
        DB::table('permissions')->insert([
            "title"      =>"invoices",
            "name"      =>"view_invoices",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"invoices",
            "name"      =>"create_invoices",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"invoices",
            "name"      =>"update_invoices",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"invoices",
            "name"      =>"delete_invoices",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function visits()
    {
        DB::table('permissions')->insert([
            "title"      =>"visits",
            "name"      =>"view_visits",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"visits",
            "name"      =>"create_visits",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"visits",
            "name"      =>"update_visits",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"visits",
            "name"      =>"delete_visits",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }
    private function followUpCards()
    {
        DB::table('permissions')->insert([
            "title"      =>"follow_up_cards",
            "name"      =>"view_follow_up_cards",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"follow_up_cards",
            "name"      =>"create_follow_up_cards",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"follow_up_cards",
            "name"      =>"update_follow_up_cards",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"follow_up_cards",
            "name"      =>"delete_follow_up_cards",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }
    private function followUpCardSpecialReports()
    {
        DB::table('permissions')->insert([
            "title"      =>"follow_up_card_special_reports",
            "name"      =>"view_follow_up_card_special_reports",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"follow_up_card_special_reports",
            "name"      =>"create_follow_up_card_special_reports",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"follow_up_card_special_reports",
            "name"      =>"update_follow_up_card_special_reports",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"follow_up_card_special_reports",
            "name"      =>"delete_follow_up_card_special_reports",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }
    private function references()
    {
        DB::table('permissions')->insert([
            "title"      =>"references",
            "name"      =>"view_references",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"references",
            "name"      =>"create_references",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"references",
            "name"      =>"update_references",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"references",
            "name"      =>"delete_references",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }
    private function indexations()
    {
        DB::table('permissions')->insert([
            "title"      =>"indexations",
            "name"      =>"view_indexations",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"indexations",
            "name"      =>"create_indexations",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"indexations",
            "name"      =>"update_indexations",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"indexations",
            "name"      =>"delete_indexations",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

    private function employees()
    {
        DB::table('permissions')->insert([
            "title"      =>"employees",
            "name"      =>"view_employees",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"employees",
            "name"      =>"create_employees",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"employees",
            "name"      =>"update_employees",
            "created_at"=>Carbon\Carbon::now(),
            ]);
        DB::table('permissions')->insert([
            "title"      =>"employees",
            "name"      =>"delete_employees",
            "created_at"=>Carbon\Carbon::now(),
            ]);
    }

}
