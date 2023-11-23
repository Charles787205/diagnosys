<?php 
require_once 'Database.php';
require_once '../Objects/Patient.php';
class PatientModel extends Database{



  public function getAllPatients() {
    $sql = 'SELECT * FROM patient';

    $result = $this->connection->query($sql);

    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $patients = array();
        foreach($data as $d){
          $patient = new Patient();
          $patient->id = $d['id'];
          $patient->first_name = $d['first_name'];
          $patient->last_name = $d['last_name'];
          $patient->birthdate = $d['birthdate'];
          $patient->age = $d['age'];
          $patient->city = $d['city'];
          $patient->barangay = $d['purok'];
          $patient->mobile_number = $d['mobile_number'];
          $patient->image_url = $d['image_url'];
          $patients[] = $patient;
        }
        $result->close();
        return $patients;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
}
public function getPatientById($patientId) {
    $sql = 'SELECT * FROM patient WHERE id = ?';
    try {
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('i', $patientId);
        $stmt->execute();

        $result = $stmt->get_result();
        $patient = $result->fetch_object('Patient');
        $this->connection->close();
        return $patient;
    } catch (Exception $error) {
        return null;
    }
}
  
  public function getOrCreatePatient(Patient $patient){
    //Get patient object if it exist otherwise create a new patient
    $existingPatient = $this->getPatientWithFirstNameAndLastName($patient->first_name, $patient->last_name);
    if($existingPatient){
      return $existingPatient;
    }else{
      $sql = 'INSERT INTO patient (first_name, last_name, birthdate, age, province, city, barangay, purok, mobile_number, image_url, gender) VALUES (?,?, DATE(?) ,?,?,?,?,?,?,?,?);';
      $statement = $this->connection->prepare($sql);
      $statement->bind_param('sssisssssss', $patient->first_name, $patient->last_name, $patient->birthdate,$patient->age, $patient->province, $patient->city, $patient->barangay, $patient->purok, $patient->mobile_number, $patient->image_url, $patient->gender);
      $statement->execute();
      $id = $this->connection->insert_id;
      $patient->id = $id;
      $this->connection->close();
      return $patient;
    }

  }

  public function getPatientWithFirstNameAndLastName($firstname, $lastname){
    $sql = 'SELECT * FROM patient WHERE first_name = ? AND last_name = ?';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('ss', $firstname, $lastname);
    $statement->execute();
    $result = $statement->get_result();
    if($result){
      $patient = new Patient();
      $patient = $result->fetch_object('Patient');
      return $patient;
      $this->connection->close();
    }else{
      return false;
    }
  }

}