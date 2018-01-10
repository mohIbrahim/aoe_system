<?php
namespace App\AOE\RBAC;

interface UserPermissionInterface
{
    public function getPermissions($user);
}
