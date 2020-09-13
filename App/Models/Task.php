<?php

namespace App\Models;

class Task extends Model
{
		private $id;
    private $user_id;
    private $name;
    private $description;
    private $status;

    public function __construct($task_data = [])
    {

        if (isset($task_data['id'])) {
            $this->id=$task_data['id'];
            $this->$user_id = @$task_data['user_id'];
            $this->name = @$task_data['name'];
            $this->description = @$task_data['description'];
            $this->status = @$task_data['status'];
        }
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function toArray() {
        return [
            "id" => $this->getId(),
            "user_id" => $this->getUserId(),
            "name" => $this->getName(),
            "description" => $this->getDescription(),
            "status" => $this->getStatus()
        ];
    }

    public function getTableName(){
        return "TASKS";
    }

		public function validate(){
			$errorMessages = [];
			if ($this->getName() == null)
			{
					$message = "Please specify name";
					$errorMessages[count($errorMessages)] = $message;
			}

			if ($this->getDescription() == null)
			{
					$message = "Please specify description";
					$errorMessages[count($errorMessages)] = $message;
			}

			return $errorMessages;
		}

    public function isCompleted(){
        if (!empty($this->getStatus()) && $this->getStatus()==="COMPLETED")
        {
            return true;
        }

        return false;
    }

    public function isAssigned(){
        if (!empty($this->getUserId()))
        {
            return true;
        }

        return false;
    }
}
