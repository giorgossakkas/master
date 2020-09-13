<?php

namespace Core;

class Connection {


    public static function make()
    {

      $config = require "config.php";

      $dsn = "mysql:host=".$config['db_host'].";dbname=".$config['db_name'].";charset=".$config['db_charset'];
      $pdo =  new \PDO($dsn, $config['db_user'], $config['db_password'], $config['db_options']);

      return $pdo;
    }

}
