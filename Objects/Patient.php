<?php
require_once 'User.php';
class Patient extends User
{
  public $id;
  public $birthdate;
  public $age;
  public $province;
  public $city;
  public $barangay;
  public $purok;
  public $mobile_number;
  public $user_id, $gender;
  public $image_url;
  public $subdivision, $house_no;
  public $status;

  public function getFullName()
  {
    return strtoupper($this->first_name . ' ' . $this->last_name);
  }
  public function getFullAddress()
  {
    return strtoupper($this->house_no . ', ' . $this->subdivision . ',' . $this->purok . ', ' . $this->barangay . ', ' . $this->city);
  }
  public function fill($data)
  {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->$key = $value;
      }
    }
  }
}
