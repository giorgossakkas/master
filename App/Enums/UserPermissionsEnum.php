<?php

namespace App\Enums;

class UserPermissionsEnum extends Enum
{

    const MANAGE_ROLES = "Manage roles";
    const MANAGE_TEAM_LEADERS = "Manage team leaders";
    const MANAGE_USERS = "Manage users";
    const MANAGE_TASKS = "Manage tasks";
    const COMPLETE_TASKS = "Complete tasks";

}
