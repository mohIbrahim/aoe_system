<?php

namespace App\Http\Middleware;

use Closure;

class References
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

        if($request->route()->getName() == 'references.index'      && in_array('view_references', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'references.show'       && in_array('view_reference', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'references.create'     && in_array('create_references', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'references.store'      && in_array('create_references', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'references.edit'       && in_array('update_references', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'references.update'     && in_array('update_references', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'references.destroy'    && in_array('delete_references', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'remove_the_reference_file'    && in_array('update_references', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'references_search'    && in_array('view_references', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'create_reference_with_printing_machine_id'    && in_array('create_references', $permissions)){

			$response = $next($request);
		}else

		if($request->route()->getName() == 'references_pm_search'    && (in_array('create_references', $permissions) || in_array('update_references', $permissions))){
            $response = $next($request);
        } else

        if($request->route()->getName() == 'reference_close'    && (in_array('update_references', $permissions) )){
            $response = $next($request);
        } else
        if (($request->route()->getName() == 'references_as_excel') && in_array('view_references_excel', $permissions)) {
            $response = $next($request);
        } elseif (in_array('view_references_reports', $permissions)) {

            if ($request->route()->getName() == 'references_during_last_two_working_days_report'    && (in_array('view_references_during_last_two_working_days_report', $permissions) )){
                $response = $next($request);
            } elseif ( $request->route()->getName() == 'references_still_open_after_forty_eight_hours_report'    && (in_array('view_references_still_open_after_forty_eight_hours_report', $permissions) )){
                $response = $next($request);
            } elseif($request->route()->getName() == 'index_references_in_specific_period_report' && (in_array('view_references_in_specific_period_report', $permissions) )) {
                $response = $next($request);
            } elseif ($request->route()->getName() == 'get_references_in_specific_period_report' && (in_array('view_references_in_specific_period_report', $permissions) )) {
                $response = $next($request);
            } else {
                abort(403);
            }

        } else{
            abort(403);
        }

        return $response;
    }
}
