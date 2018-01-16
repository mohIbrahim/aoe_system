<?php

namespace App\Http\Middleware;

use Closure;

class Invoices
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

        if($request->route()->getName() == 'invoices.index'      && in_array('view_invoices', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.show'       && in_array('view_invoices', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.create'     && in_array('create_invoices', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.store'      && in_array('create_invoices', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.edit'       && in_array('update_invoices', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.update'     && in_array('update_invoices', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'invoices.destroy'    && in_array('delete_invoices', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'invoices_search'    && in_array('view_invoices', $permissions)){

            $response = $next($request);
        }else{
            flash()->warning('<h3><img src="'.asset("images/helper_images/logo-accessdenied.png").'" width="80">  Ask IT Manager for Permission!</h3>');
        }

        return $response;
    }
}
