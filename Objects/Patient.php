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
  public $middle_name;
  public $purok;
  public $mobile_number;
  public $user_id, $gender;
  public $image_url;
  public $subdivision, $house_no;
  public $status;
  public $id_type;
  public $suffix;

  public function getFullName()
  {
    return strtoupper($this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . " " . (isset($suffix) ? $this->suffix : ''));
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
  public function getSuffix()
  {
    return isset($this->suffix) ? $this->suffix : "";
  }
}
