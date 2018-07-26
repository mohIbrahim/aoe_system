<?php

namespace App\Http\Middleware;

use Closure;

class Customers
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

        if($request->route()->getName() == 'customers.index'      && in_array('view_customers', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'customers.show'       && in_array('view_customer', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'customers.create'     && in_array('create_customers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'customers.store'      && in_array('create_customers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'customers.edit'       && in_array('update_customers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'customers.update'     && in_array('update_customers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'customers.destroy'    && in_array('delete_customers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'customers_as_excel'    && in_array('view_customers_excel', $permissions)){
            $response = $next($request);
        }else
        
		if($request->route()->getName() == 'customers_search'    && in_array('view_customers', $permissions)){

            $response = $next($request);
        }else{
            abort(403);
        }


        return $response;

    }
}
