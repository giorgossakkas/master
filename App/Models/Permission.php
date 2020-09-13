<?php

namespace App\Models;

class Permission extends Model
{

  private $id;
  private $type;
  private $role_id;

  public function getId()
  {
      return $this->id;
  }

  public function setId($id)
  {
      $this->id = $id;
  }
  public function getType()
  {
      return $this->type;
  }

  public function setType($type)
  {
      $this->type = $type;
  }

  public function getRoleId()
  {
      return $this->role_id;
  }

  public function setRoleId($roleId)
  {
      $this->role_id = $roleId;
  }

  public function toArray () {
      return [
          "id" => $this->getId(),
          "type" => $this->getType(),
          "role_id" => $this->getRoleId(),
      ];
  }

  public function getTableName(){
      return "PERMISSIONS";
  }

  public function validate(){
      $errorMessages = [];

      return $errorMessages;
  }


}
