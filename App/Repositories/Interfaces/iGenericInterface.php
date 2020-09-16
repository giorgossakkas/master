<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface iGenericInterface
{
    public function getAll();

    public function find($id);

    public function findBy($field_name, $field_value);

    public function findAllBy($field_name, $field_value);

    //public function getBasicQuery(): Builder;

    public function create($entity);

    public function update($entity);

    public function delete($id);
}
