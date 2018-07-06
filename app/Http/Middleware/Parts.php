<?php

namespace App\Http\Middleware;

use Closure;

class Parts
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

        if($request->route()->getName() == 'parts.index'      && in_array('view_parts', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'parts.show'       && in_array('view_part', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'parts.create'     && in_array('create_parts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'parts.store'      && in_array('create_parts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'parts.edit'       && in_array('update_parts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'parts.update'     && in_array('update_parts', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'parts.destroy'    && in_array('delete_parts', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'parts_search'    && in_array('view_parts', $permissions)){

            $response = $next($request);
        }else{
            abort(403);
        }

        return $response;
    }
}
