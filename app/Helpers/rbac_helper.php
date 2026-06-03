<?php

function hasPermission($permission)
{
    $permissions = session()->get('permissions');

    if (!$permissions) {
        return false;
    }

    return in_array($permission, $permissions);
}

function hasRole($role)
{
    return session()->get('vai_tro') === $role;
}