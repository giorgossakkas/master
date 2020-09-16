<?php

namespace App\Repositories\DB;

use Core\Connection;
use Core\QueryBuilder;

abstract class AbstractDBRepository
{
    public static function getDB()
    {
        static $query = null;

        if ($query === null) {

            $pdo = Connection::make();

            $query = new QueryBuilder($pdo);
        }

        return $query;
    }
}
