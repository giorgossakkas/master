<?php

namespace App\Models;

class User extends Model
{
		private $id;
    private $user_name;
    private $email;
    private $password;

    public function __construct($user_data = [])
    {
        if (isset($user_data['id'])) {
            $this->id = $user_data['id'];
            $this->$user_name = @$user_data['user_name'];
            $this->email = @$user_data['email'];
            $this->password = @$user_data['password'];
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
    public function getUserName()
    {
        return $this->user_name;
    }

    public function setUserName($userName)
    {
        $this->user_name = $userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function toArray () {
        return [
            "id" => $this->getId(),
            "user_name" => $this->getUserName(),
            "email" => $this->getEmail(),
            "password" => $this->getPassword()
        ];
    }

    public function getTableName(){
        return "USERS";
    }

		public function validate(){
				$errorMessages = [];
				if ($this->getUserName() == null)
				{
						$message = "Please specify username";
						$errorMessages[count($errorMessages)] = $message;
				}

				if ($this->getEmail() == null)
				{
						$message = "Please specify email";
						$errorMessages[count($errorMessages)] = $message;
				}

				return $errorMessages;
		}
}
