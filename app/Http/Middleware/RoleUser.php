<?php

namespace App\Http\Middleware;

use Closure;

class RoleUser
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


        if($request->route()->getName() == 'role_user.edit'       && in_array('update_users', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'role_user.update'     && in_array('update_users', $permissions)){

            $response = $next($request);
        }else{
            abort(403);
        }


        return $response;
    }
}
