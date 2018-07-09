<?php

namespace App\Http\Middleware;

use Closure;

class Indexations
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
        if (isset($user)) {
            if ( $user->roles() !== null && $user->roles()->first() !== null && $user->roles()->first()->permissions() !== null ) {
                $permissions = $user->roles()->first()->permissions()->pluck('name')->toArray();
            } else {
                return $response;
            }
        }

        if ($request->route()->getName() == 'indexations.index' && in_array('view_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'indexations.show'  && in_array('view_indexation', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'indexations.create' && in_array('create_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'indexations.store' && in_array('create_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'indexations.edit'  && in_array('update_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'indexations.update' && in_array('update_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'indexations.destroy' && in_array('delete_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'remove_the_indexation_file' && in_array('update_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'indexations_search' && in_array('view_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'indexation_form_part_search' && in_array('create_indexations', $permissions)) {
            $response = $next($request);
        } elseif ($request->route()->getName() == 'create_indexations_with_visit_id' && in_array('create_indexations', $permissions)) {
            $response = $next($request);
        } elseif (in_array('view_indexations_reports', $permissions)) {
            if ($request->route()->getName('get_indexation_released_in_specific_period_report') && in_array('view_indexations_released_in_specific_period_report', $permissions)) {
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
