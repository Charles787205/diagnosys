<?php
require_once 'User.php';


class Employee extends User
{
  public  $user_id, $position;

  public function newEmployee($first_name, $last_name, $username, $password, $position, $age, $address, $mobile_number)
  {
    $this->position = $position;
    parent::newUser($first_name, $last_name, $username, $password, $age, $address, $mobile_number);
  }

  public function checkIfValuesFilled()
  {
    $isError = true;
    if ($this->first_name == "" || $this->first_name == null) {
      $isError = false;
    }
    if ($this->last_name == "" || $this->last_name == null) {
      $isError = false;
    }
    if ($this->username == "" || $this->username == null) {
      $isError = false;
    }
    if ($this->password == "" || $this->password == null) {
      $isError = false;
    }
    if ($this->position == "" || $this->position == null) {
      $isError = false;
    }
    if ($this->age == "" || $this->age == null) {
      $isError = false;
    }
    if ($this->address == "" || $this->address == null) {
      $isError = false;
    }
    if ($this->mobile_number == "" || $this->mobile_number == null) {
      $isError = false;
    }
    return $isError;
  }
}
