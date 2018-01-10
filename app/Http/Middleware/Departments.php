<?php

namespace App\Http\Middleware;

use Closure;
use App\AOE\RBAC\UserPermissionInterface;
class Departments
{
    private $userPermissions;

    public function __construct(UserPermissionInterface $userPermissions)
    {
        $this->userPermissions = $userPermissions;
    }
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
        $permissions = $this->userPermissions->getPermissions($user);

        if(empty($permissions))
            return $response;

        if($request->route()->getName() == 'departments.index'      && in_array('view_departments', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'departments.show'       && in_array('view_departments', $permissions)){

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
            flash()->warning('<h3><img src="'.asset("images/helper_images/logo-accessdenied.png").'" width="80">  Ask IT Manager for Permission!</h3>');
        }


        return $response;
    }
}
