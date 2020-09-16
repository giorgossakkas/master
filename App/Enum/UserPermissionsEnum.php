<?php

namespace App\Enum;

class UserPermissionsEnum
{
    const MANAGE_ROLES = "MANAGE_ROLES";
    const MANAGE_TEAM_LEADERS = "MANAGE_TEAM_LEADERS";
    const MANAGE_USERS = "MANAGE_USERS";
    const MANAGE_TASKS = "MANAGE_TASKS";
    const COMPLETE_TASKS = "COMPLETE_TASKS";

    /**
     * Return all above permissions;
     * @return array
     * @throws \ReflectionException
     */
    public static function getAllPermissions()
    {
        $reflectionClass = new \ReflectionClass(__CLASS__);
        return array_values($reflectionClass->getConstants());
    }
}
