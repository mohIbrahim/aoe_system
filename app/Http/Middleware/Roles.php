<?php

namespace App\Http\Middleware;

use Closure;

class Roles
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

        $response = redirect(action('HomeController@index'));


        $user = $request->user();
        $permissions = [];
        if(isset($user)){
            if( $user->roles() !== null && $user->roles()->first() !== null && $user->roles()->first()->permissions() !== null ){
                $permissions = $user->roles()->first()->permissions()->pluck('name')->toArray();
            }
            else
                return $response;
        }

        if($request->route()->getName() == 'roles.index'      && in_array('view_roles', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'roles.show'       && in_array('view_role', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'roles.create'     && in_array('create_roles', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'roles.store'      && in_array('create_roles', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'roles.edit'       && in_array('update_roles', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'roles.update'     && in_array('update_roles', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'roles.destroy'    && in_array('delete_roles', $permissions)){

            $response = $next($request);
        }else{
            abort(403);
        }


        return $response;
    }
}
