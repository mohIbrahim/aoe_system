<?php

namespace App\Http\Middleware;

use Closure;

class PrintingMachines
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

        if($request->route()->getName() == 'printing_machines.index'      && in_array('view_printing_machines', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.show'       && in_array('view_printing_machine', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.create'     && in_array('create_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.store'      && in_array('create_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.edit'       && in_array('update_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.update'     && in_array('update_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.destroy'    && in_array('delete_printing_machines', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'printing_machines_search'    && in_array('view_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines_as_excel'    && in_array('view_printing_machines_excel', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'create_printing_machine_with_customer'    && in_array('create_printing_machines', $permissions)){

            $response = $next($request);
        } else 

        if(in_array('view_printing_machines_reports', $permissions)) {
            if($request->route()->getName() == 'printing_machines_without_follow_up_cards_report' && in_array('view_printing_machines_without_follow_up_cards_report', $permissions) ) {
                $response = $next($request);
            }else{
                abort(403);
            }
        }
        else{
            abort(403);
        }


        return $response;
    }
}
