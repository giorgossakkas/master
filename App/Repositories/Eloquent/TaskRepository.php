<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use App\Models\Task;
use Core\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class TaskRepository implements EloquentRepositoryInterface
{
    public function getBasicQuery(): Builder
    {
        return Task::query();
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

    public function create($task)
    {
        $task->save();

        return $task;
    }

    public function update($task)
    {
        $task->update();

        return $task;
    }

    public function delete($id)
    {
        $task = $this->find($id);
        $task->delete();

    }

}
