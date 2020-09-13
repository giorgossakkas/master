<?php

namespace App\Models;

class User extends Model
{
		private $id;
    private $user_name;
    private $email;
    private $password;
    private $role_id;
		private $team_leader_id;
		private $is_team_leader;

    public function __construct($user_data = [])
    {
        if (isset($user_data['id'])) {
            $this->id = $user_data['id'];
            $this->$user_name = @$user_data['user_name'];
            $this->email = @$user_data['email'];
            $this->password = @$user_data['password'];
            $this->role_id = @$user_data['role_id'];
            $this->team_leader_id = @$user_data['team_leader_id'];
            $this->is_team_leader = @$user_data['is_team_leader'];
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

		public function getRoleId()
		{
				return $this->role_id;
		}

		public function setRoleId($role_id)
		{
				$this->role_id = $role_id;
		}

		public function getTeamLeaderId()
		{
				return $this->team_leader_id;
		}

		public function setTeamLeaderId($team_leader_id)
		{
				$this->team_leader_id = $team_leader_id;
		}

		public function getIsTeamLeader()
		{
				return $this->is_team_leader;
		}

		public function setIsTeamLeader($is_team_leader)
		{
				$this->is_team_leader = $is_team_leader;
		}

		public function isTeamLeader(){
        if (!empty($this->getIsTeamLeader()) && $this->getIsTeamLeader()===1)
        {
            return true;
        }

        return false;
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
            "password" => $this->getPassword(),
            "role_id" => $this->getRoleId(),
            "team_leader_id" => $this->getTeamLeaderId(),
            "is_team_leader" => $this->getIsTeamLeader()
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

				if ($this->getRoleId() == null)
				{
						$message = "Please specify role";
						$errorMessages[count($errorMessages)] = $message;
				}

				if ($this->getTeamLeaderId() == null && !$this->isTeamLeader())
				{
						$message = "Please specify team leader";
						$errorMessages[count($errorMessages)] = $message;
				}

				return $errorMessages;
		}

		public function validateRegistration(){
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
