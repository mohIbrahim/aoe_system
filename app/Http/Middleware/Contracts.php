<?php

namespace App\Http\Middleware;

use Closure;

class Contracts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = redirect(route('welcome'));

        $user = $request->user();
        $permissions = [];
        if(isset($user)){
            if( $user->roles() !== null && $user->roles()->first() !== null && $user->roles()->first()->permissions() !== null ){
                $permissions = $user->roles()->first()->permissions()->pluck('name')->toArray();
            }
            else
                return $response;
        }

        if($request->route()->getName() == 'contracts.index'      && in_array('view_contracts', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'contracts.show'       && in_array('view_contract', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'contracts.create'     && in_array('create_contracts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'contracts.store'      && in_array('create_contracts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'contracts.edit'       && in_array('update_contracts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'contracts.update'     && in_array('update_contracts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'contracts.destroy'    && in_array('delete_contracts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'remove_the_contract_file'    && in_array('update_contracts', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'contracts_search'    && in_array('view_contracts', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'create_contract_with_printing_machine_id'    && in_array('create_contracts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'contracts_pm_search'    && (in_array('create_contracts', $permissions) || in_array('update_contracts', $permissions))){
            $response = $next($request);
        } else

        if( in_array('view_contracts_reports', $permissions) ){
            if ($request->route()->getName() == 'contracts_expire_within_next_3_monthes_report' && in_array('view_contracts_expire_within_next_3_monthes_report', $permissions)) {
                $response = $next($request);
            } else if ($request->route()->getName() == 'contracts_invoices_are_due_in_this_month_report' && in_array('view_contracts_invoices_are_due_in_this_month_report', $permissions)) {
                $response = $next($request);
            } else {
                abort(403);
            }
            
        } else {
            abort(403);
        }

        return $response;
    }
}
