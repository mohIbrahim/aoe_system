<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeNavigationPrivilages();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composeNavigationPrivilages()
    {
        $v =    [
                    'layouts.nav.main_nav',
                    'roles.show',
                    'users.show',
                    'permissions.show',
                    'role_user._form',
    				'printing_machines.show',
                    'customers.show',
                    'departments.show',
                    'parts.show',
                    'part_serial_numbers.show',
                    'installation_records.show',
                    'contracts.show',
                    'invoices.show',
                    'visits.show',
                    'follow_up_cards.show',
                    'follow_up_card_special_reports.show',
                ];

        view()->composer($v, function($view){

            $permissions = [];

            $aUser = Auth::user();
            if(isset($aUser)) {
                $userRoles = $aUser->roles;
                if ($userRoles->isNotEmpty()) {
                    foreach($userRoles as $key=>$role) {

                        $permissions = array_merge($permissions, $role->permissions()->pluck('name')->toArray()) ;

                    }
                }
            }
            $view->with('permissions', $permissions);

        });
    }
}
