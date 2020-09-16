<?php

namespace App\Models;

use App\Repositories\DB\RoleRepository;

class Role extends Model
{

  private $id;
  private $name;
  private $permissions;
  private $permissionsToRemove;

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

  public function getPermissions()
  {
      return $this->permissions;
  }

  public function setPermissions($permissions)
  {
      $this->permissions = $permissions;
  }

  public function getPermissionsToRemove()
  {
      return $this->permissionsToRemove;
  }

  public function setPermissionsToRemove($permissionsToRemove)
  {
      $this->permissionsToRemove = $permissionsToRemove;
  }

  public function toArray () {
      return [
          "id" => $this->getId(),
          "name" => $this->getName()
      ];
  }

  public function getTableName(){
      return "ROLES";
  }

  public function validate(){
      $errorMessages = [];
      if ($this->getName() == null)
      {
          $message = "Please specify name";
          $errorMessages[count($errorMessages)] = $message;
      }

      return $errorMessages;
  }

}
