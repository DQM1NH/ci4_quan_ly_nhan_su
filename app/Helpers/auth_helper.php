<?php

function hasPermission($permission)
{
    $permissions = session()->get('permissions');

    return in_array($permission, $permissions);
}