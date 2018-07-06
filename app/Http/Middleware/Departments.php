<?php

namespace App\Http\Middleware;

use Closure;
class Departments
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

        if($request->route()->getName() == 'departments.index'      && in_array('view_departments', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'departments.show'       && in_array('view_department', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'departments.create'     && in_array('create_departments', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'departments.store'      && in_array('create_departments', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'departments.edit'       && in_array('update_departments', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'departments.update'     && in_array('update_departments', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'departments.destroy'    && in_array('delete_departments', $permissions)){

            $response = $next($request);
        }
        else{
            abort(403);
        }


        return $response;
    }
}
