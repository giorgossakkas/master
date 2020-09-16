<?php

namespace App\Models;

use Core\Connection;
use Core\QueryBuilder;

abstract class Model {

		abstract public function getTableName();
		abstract public function validate();
		abstract public function toArray();

}
