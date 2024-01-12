<?php 
require_once 'User.php';


class Employee extends User{
  public  $user_id, $position;

  public function newEmployee($first_name, $last_name, $username, $password, $position,$age, $address, $mobile_number){
    $this->position = $position;
    parent::newUser($first_name, $last_name, $username, $password,$age, $address, $mobile_number);
    
  }
}