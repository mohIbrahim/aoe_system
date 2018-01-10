<?php
namespace App\AOE\RBAC;

class UserPermission implements UserPermissionInterface
{
    public function getPermissions($user)
    {
        $permissions = [];
        if(isset($user)){
            if( $user->roles() !== null && $user->roles()->first() !== null && $user->roles()->first()->permissions() !== null ){
                $permissions = $user->roles()->first()->permissions()->pluck('name')->toArray();
            }
        }
        return $permissions;
    }
}
