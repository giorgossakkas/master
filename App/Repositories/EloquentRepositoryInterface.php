<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{

    public function getAll();

    public function find($id);

    public function findBy($field_name, $field_value);

    public function findAllBy($field_name, $field_value);

    public function getBasicQuery(): Builder;

    public function create($entity);

    public function update($entity);

    public function delete($id);
}
