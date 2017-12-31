<?php

namespace App\Http\Middleware;

use Closure;

class Users
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
       
        if($request->route()->getName() == 'users.index'      && in_array('view_users', $permissions)){
            $response = $next($request);
        }else        
       
        if($request->route()->getName() == 'users.show'       && in_array('view_users', $permissions)){
           
            $response = $next($request);
        }else

        if($request->route()->getName() == 'users.create'     && in_array('create_users', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'users.store'      && in_array('create_users', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'users.edit'       && in_array('update_users', $permissions)){
            
            $response = $next($request);
        }else

        if($request->route()->getName() == 'users.update'     && in_array('update_users', $permissions)){
            
            $response = $next($request);
        }else

        if($request->route()->getName() == 'users.destroy'    && in_array('delete_users', $permissions)){

            $response = $next($request);
        }else{
            flash()->warning('<h3><img src="'.asset("images/helper_images/logo-accessdenied.png").'" width="80">  Ask IT Manager for Permission!</h3>');
        }


        return $response;
    }
}
