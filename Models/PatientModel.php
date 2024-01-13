<?php
require_once 'Database.php';
require_once 'RequestModel.php';
require_once __DIR__ . '/../Objects/Patient.php';
class PatientModel extends Database
{




  public function getAllPatients()
  {
    $sql = 'SELECT * FROM patient';
    $result = $this->connection->query($sql);

    if ($result) {
      $patients = array();
      while ($patient = $result->fetch_object('Patient')) {
        $patients[] = $patient;
      }
      $result->close();
      return $patients;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }

  public function getPatientById($patientId)
  {
    $sql = 'SELECT * FROM patient WHERE id = ?';
    try {
      $stmt = $this->connection->prepare($sql);
      $stmt->bind_param('i', $patientId);
      $stmt->execute();

      $result = $stmt->get_result();
      $patient = $result->fetch_object('Patient');
      $this->close();
      return $patient;
    } catch (Exception $error) {
      return null;
    }
  }

  public function getOrCreatePatient(Patient $patient)
  {
    //Get patient object if it exist otherwise create a new patient

    $existingPatient = $this->getPatientWithFirstNameAndLastName($patient->first_name, $patient->last_name);
    if ($existingPatient) {
      return $existingPatient;
    } else {
      $sql = 'INSERT INTO patient (first_name, last_name, birthdate, age, province, city, barangay, purok, subdivision, house_no, mobile_number, image_url, gender) VALUES (?,?, DATE(?) ,?,?,?,?,?,?,?,?,?,?);';
      $statement = $this->connection->prepare($sql);
      $statement->bind_param('sssisssssssss', $patient->first_name, $patient->last_name, $patient->birthdate, $patient->age, $patient->province, $patient->city, $patient->barangay, $patient->purok, $patient->subdivision, $patient->house_no, $patient->mobile_number, $patient->image_url, $patient->gender);
      $statement->execute();
      $id = $this->connection->insert_id;
      $patient->id = $id;
      $this->connection->close();
      return $patient;
    }
  }

  public function getPatientWithFirstNameAndLastName($firstname, $lastname)
  {
    $sql = 'SELECT * FROM patient WHERE first_name = ? AND last_name = ?';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('ss', $firstname, $lastname);
    $statement->execute();
    $result = $statement->get_result();
    if ($result) {
      $patient = new Patient();
      $patient = $result->fetch_object('Patient');
      return $patient;
    } else {
      return false;
    }
  }
  public function deletePatient($patientId)
  {
    $sql = 'DELETE FROM patient WHERE id = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $patientId);

    if ($statement->execute()) {
      // Patient deleted successfully
      $this->connection->close();
      return true;
    } else {
      // Handle the case where the deletion fails
      return false;
    }
  }
  public function editPatient(Patient $patient)
  {
    $this->checkConnection();

    // Update the patient
    $sql = "UPDATE patient SET first_name = ?, last_name = ?, birthdate = DATE(?), age = ?, province = ?, city = ?, barangay = ?, purok = ?, mobile_number = ?, image_url = ?, gender = ? WHERE id = ?;";
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('sssisssssssi', $patient->first_name, $patient->last_name, $patient->birthdate, $patient->age, $patient->province, $patient->city, $patient->barangay, $patient->purok, $patient->mobile_number, $patient->image_url, $patient->gender, $patient->id);
    $statement->execute();

    $this->close();
  }
}
