<?php

namespace App\Http\Middleware;

use Closure;

class InstallationRecords
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

        if($request->route()->getName() == 'installation_records.index'      && in_array('view_installation_records', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'installation_records.show'       && in_array('view_installation_record', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'installation_records.create'     && in_array('create_installation_records', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'installation_records.store'      && in_array('create_installation_records', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'installation_records.edit'       && in_array('update_installation_records', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'installation_records.update'     && in_array('update_installation_records', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'installation_records.destroy'    && in_array('delete_installation_records', $permissions)){

            $response = $next($request);
        }else
            if($request->route()->getName() == 'remove_the_installation_record_file'    && in_array('update_installation_records', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'installation_records_pm_search'   && (in_array('create_installation_records', $permissions) || in_array('update_installation_records', $permissions))){
            $response = $next($request);
        }else

		if($request->route()->getName() == 'create_installtion_record_with_printing_machine'   && (in_array('create_installation_records', $permissions))){
            $response = $next($request);
        }else{
            abort(403);
        }

        return $response;

    }
}
