<?php

namespace App\Http\Middleware;

use Closure;

class Invoices
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

        if($request->route()->getName() == 'invoices.index'      && in_array('view_invoices', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.show'       && in_array('view_invoice', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.create'     && in_array('create_invoices', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.store'      && in_array('create_invoices', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.edit'       && in_array('update_invoices', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.update'     && in_array('update_invoices', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.destroy'    && in_array('delete_invoices', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'remove_the_invoice_file'    && in_array('update_invoices', $permissions)){
            $response = $next($request);
        }else

		if($request->route()->getName() == 'invoices_search'    && in_array('view_invoices', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices_form_part_search'    && in_array('create_invoices', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'create_invoice_with_customer'    && in_array('create_invoices', $permissions)){

            $response = $next($request);
        }else

        if( in_array('view_invoices_reports', $permissions)){
            if($request->route()->getName() == 'responsible_employees_for_invoices_not_paid_report'    && in_array('view_responsible_employees_for_invoices_not_paid_report', $permissions)){
                $response = $next($request);
            }else if ($request->route()->getName() == 'get_invoices_released_in_specific_period_report'    && in_array('view_invoices_released_in_specific_period_report', $permissions)){
                $response = $next($request);
            } else if ($request->route()->getName() == 'invoices_released_in_specific_period_report_search'    && in_array('view_invoices_released_in_specific_period_report', $permissions)){
                $response = $next($request);
            } else {
                abort(403);
            }
        }
        else{
            abort(403);
        }
        return $response;
    }
}
