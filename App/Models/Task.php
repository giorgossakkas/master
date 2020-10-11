<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatusEnum;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','assign_to_user_id','owner_user_id'
    ];


    public function isCompleted()
    {
        if ($this->status!=null && $this->status === TaskStatusEnum::COMPLETED)
        {
            return true;
        }

        return false;
    }
}
