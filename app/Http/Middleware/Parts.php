<?php

namespace App\Http\Middleware;

use Closure;
use App\AOE\RBAC\UserPermissionInterface;

class Parts
{
    private $permissions ;

    public function __construct(UserPermissionInterface $permissions)
    {
        $this->permissions = $permissions;
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

        $permissions = $this->userPermissions->getPermissions($request->user());

        if(empty($permissions))
            return $response;

        $isAllowed = $this->userPermissions->isAllowed($request->route()->getName(), 'parts', $permissions);
        if($isAllowed){
            $response = $next($request);
        }
        return $response;
    }
}
