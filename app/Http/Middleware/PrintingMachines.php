<?php

namespace App\Http\Middleware;

use Closure;

class PrintingMachines
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

        if($request->route()->getName() == 'printing_machines.index'      && in_array('view_printing_machines', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.show'       && in_array('view_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.create'     && in_array('create_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.store'      && in_array('create_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.edit'       && in_array('update_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.update'     && in_array('update_printing_machines', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'printing_machines.destroy'    && in_array('delete_printing_machines', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'printing_machines_search'    && in_array('view_printing_machines', $permissions)){

            $response = $next($request);
        }else{
            flash()->warning('<h3><img src="'.asset("images/helper_images/logo-accessdenied.png").'" width="80">  Ask IT Manager for Permission!</h3>');
        }


        return $response;
    }
}
