<?php

namespace App\Http\Middleware;

use Closure;

class Visits
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

        if($request->route()->getName() == 'visits.index'      && in_array('view_visits', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'visits.show'       && in_array('view_visit', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'visits.create'     && in_array('create_visits', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'visits.store'      && in_array('create_visits', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'visits.edit'       && in_array('update_visits', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'visits.update'     && in_array('update_visits', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'visits.destroy'    && in_array('delete_visits', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'visits_search'    && in_array('view_visits', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'visits_pm_search'    && (in_array('create_visits', $permissions) || in_array('update_visits', $permissions))){
            $response = $next($request);
        }else

		if($request->route()->getName() == 'create_visit_with_printing_machine_id'    && in_array('create_visits', $permissions) ){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'remove_the_visit_file'    && in_array('update_visits', $permissions)){

            $response = $next($request);
        }else
        
		if($request->route()->getName() == 'create_visit_with_printing_machine_id_and_follow_up_card_id'    && in_array('create_visits', $permissions) ){
            $response = $next($request);
        } else
		if ($request->route()->getName() == 'create_visit_with_printing_machine_id_and_reference_id_and_employee_id'    && in_array('create_visits', $permissions) ){
            $response = $next($request);
        } else
        if (($request->route()->getName() == 'visits_as_excel') && in_array('view_visits_excel', $permissions)) {
            $response = $next($request);
        }
        elseif(in_array('view_visits_reports', $permissions)) {
            
            if($request->route()->getName() == 'index_visits_in_specific_period_report' && in_array('view_visits_in_specific_period_report', $permissions)){
                $response = $next($request);
            } elseif($request->route()->getName() == 'get_visits_in_specific_period_report' && in_array('view_visits_in_specific_period_report', $permissions)) {
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
