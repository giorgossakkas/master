<?php

namespace Core;

use App\Enum\UserPermissionsEnum;

class SessionHandler
{
    private function startSession()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    public static function getLoggedInUserId()
    {
        self::startSession();
        if (isset($_SESSION["id"]))
        {
            return $_SESSION["id"];
        }
    }

    public static function setLoggedInUserId($id)
    {
        self::startSession();

        $_SESSION["id"] =$id;
    }

    public static function getLoggedInUserName()
    {
        self::startSession();
        if (isset($_SESSION["user_name"]))
        {
            return $_SESSION["user_name"];
        }
    }

    public static function setLoggedInUserName($userName)
    {
        self::startSession();

        $_SESSION["user_name"] =$userName;
    }

    public static function canLoggedInUserManageUsers()
    {
        return self::canUserPerformAction('MANAGE_USERS');
    }
    public static function canLoggedInUserManageTeamLeaders()
    {
        return self::canUserPerformAction('MANAGE_TEAM_LEADERS');
    }
    public static function canLoggedInUserManageTasks()
    {
        return self::canUserPerformAction('MANAGE_TASKS');
    }
    public static function canLoggedInUserManageRoles()
    {
        return self::canUserPerformAction('MANAGE_ROLES');
    }
    public static function canLoggedInUserCompleteTasks()
    {
        return self::canUserPerformAction('COMPLETE_TASKS');
    }
    public static function canUserPerformAction($action)
    {
        self::startSession();
        if (!empty($_SESSION[$action]))
        {
            return true;
        }
    }

    public static function setLoggedInUserPermissions($permissions)
    {
        self::startSession();

        if (count($permissions) > 0)
        {
             foreach ($permissions as $permission)
             {
                 $_SESSION[$permission->getType()] = true;
             }
        }
    }

    public static function create($user,$permissions)
    {
        self::startSession();

        self::setLoggedInUserId($user->getId());
        self::setLoggedInUserName($user->getUserName());
        self::setLoggedInUserPermissions($permissions);
    }

    public static function destroy()
    {
        self::startSession();

        unset($_SESSION["id"]);
        unset($_SESSION["user_name"]);

        $allPermissions = UserPermissionsEnum::getAllPermissions();

        foreach ($allPermissions as $permission)
        {
            unset($_SESSION[$permission]);
        }

    }

}
