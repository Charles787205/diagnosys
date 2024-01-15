<?php

class User
{
  public $id, $first_name, $last_name, $username, $password, $age, $address, $mobile_number;
  public $sec_question, $answer;

  public function newUser($first_name, $last_name, $username, $password, $age, $address, $mobile_number)
  {

    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->username = $username;
    $this->password = $password;
    $this->age = $age;
    $this->address = $address;
    $this->mobile_number = $mobile_number;

    return $this;
  }
  public function addSecurityQuestion($sec_question, $answer)
  {
    $this->sec_question = $sec_question;
    $this->answer = $answer;
  }
  public function getFullName()
  {
    return strtoupper($this->first_name . ' ' . $this->last_name);
  }
}
