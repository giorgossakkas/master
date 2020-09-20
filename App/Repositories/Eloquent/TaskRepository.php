<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use App\Models\Task;
use Core\QueryBuilder;

class TaskRepository implements EloquentRepositoryInterface
{

    public function getAll($exclude_admin = false)
    {
        return Task::all();
    }

    public function find($id)
    {
        return Task::find($id);
    }

    public function findBy($field_name, $field_value)
    {
        return Task::where($field_name, $field_value)->first();
    }

    public function findAllBy($field_name, $field_value)
    {
        return Task::where($field_name, $field_value)->get();
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
