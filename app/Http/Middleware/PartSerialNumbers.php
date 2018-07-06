<?php

namespace App\Http\Middleware;

use Closure;

class PartSerialNumbers
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

        if($request->route()->getName() == 'part_serial_numbers.index'      && in_array('view_part_serial_numbers', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'part_serial_numbers.show'       && in_array('view_part_serial_number', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'part_serial_numbers.create'     && in_array('create_part_serial_numbers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'part_serial_numbers.store'      && in_array('create_part_serial_numbers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'part_serial_numbers.edit'       && in_array('update_part_serial_numbers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'part_serial_numbers.update'     && in_array('update_part_serial_numbers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'part_serial_numbers.destroy'    && in_array('delete_part_serial_numbers', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'part_serial_numbers_search'    && in_array('view_part_serial_numbers', $permissions)){

            $response = $next($request);
        }
        else{
            abort(403);
        }


        return $response;
    }
}
