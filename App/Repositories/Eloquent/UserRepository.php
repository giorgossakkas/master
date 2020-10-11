<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use App\Models\User;
use Core\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements EloquentRepositoryInterface
{
    public function getBasicQuery(): Builder
    {
        return User::query();
    }
    public function getAll($exclude_admin = false)
    {
        return $this->getBasicQuery()->get();
    }

    public function find($id)
    {
        return $this->getBasicQuery()->find($id);
    }

    public function findBy($field_name, $field_value)
    {
        return $this->getBasicQuery()->where($field_name, $field_value)->first();
    }

    public function findAllBy($field_name, $field_value)
    {
        return $this->getBasicQuery()->where($field_name, $field_value)->get();
    }

    public function create($user)
    {
        $user->save();

        return $user;
    }

    public function update($user)
    {
        $user->update();

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();

    }

}
