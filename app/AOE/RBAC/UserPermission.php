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


    public function isAllowed($routeName, $modelName, $permissions)
    {
        if ($routeName == ($modelName.'.index') && in_array('view_'.$modelName, $permissions)) {
            return true;
        }else if($routeName == ($modelName.'.show') && in_array('view_'.$modelName, $permissions)) {
            return true;
        }else if($routeName == ($modelName.'.create') && in_array('create_'.$modelName, $permissions)) {
            return true;
        }else if($routeName == ($modelName.'.store') && in_array('create_'.$modelName, $permissions)) {
            return true;
        }else if($routeName == ($modelName.'.edit') && in_array('update_'.$modelName, $permissions)) {
            return true;
        }else if($routeName == ($modelName.'.update') && in_array('update_'.$modelName, $permissions)) {
            return true;
        }else if($routeName == ($modelName.'.destroy') && in_array('delete_'.$modelName, $permissions)) {
            return true;
        } else {
            flash()->warning('<h3><img src="'.asset("images/helper_images/logo-accessdenied.png").'" width="80">  Ask IT Manager for Permission!</h3>');
            return false;
        }
    }
}
