<?php

namespace App\Http\Middleware;

use Closure;

class Privileges
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
       
        if($request->route()->getName() == 'permissions.index'      && in_array('view_permissions', $permissions)){
            $response = $next($request);
        }else        
       
        if($request->route()->getName() == 'permissions.show'       && in_array('view_permissions', $permissions)){
           
            $response = $next($request);
        }else

        if($request->route()->getName() == 'permissions.create'     && in_array('create_permissions', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'permissions.store'      && in_array('create_permissions', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'permissions.edit'       && in_array('update_permissions', $permissions)){
            
            $response = $next($request);
        }else

        if($request->route()->getName() == 'permissions.update'     && in_array('update_permissions', $permissions)){
            
            $response = $next($request);
        }else

        if($request->route()->getName() == 'permissions.destroy'    && in_array('delete_permissions', $permissions)){

            $response = $next($request);
        }else{
            flash()->warning('<h3><img src="'.asset("images/helper_images/logo-accessdenied.png").'" width="80">  Ask IT Manager for Permission!</h3>');
        }


        return $response;
    }
}
