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

        if($request->route()->getName() == 'visits.show'       && in_array('view_visits', $permissions)){

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
        }else{
            abort(403);
        }

        return $response;
    }
}
