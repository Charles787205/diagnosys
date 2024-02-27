<?php
require_once 'Database.php';
require_once 'RequestModel.php';
require_once __DIR__ . '/../Objects/Patient.php';
class PatientModel extends Database
{




  public function getAllPatients()
  {
    $sql = "SELECT p.*, 
    CASE WHEN r.request_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH) THEN 'Active' ELSE 'Inactive' END AS status
  FROM patient p
  LEFT JOIN (SELECT patient_id, MAX(request_date) AS request_date FROM request GROUP BY patient_id) r
  ON p.id = r.patient_id;";
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
      $stmt->bind_param('s', $patientId);
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
      $sql = 'INSERT INTO patient (first_name, last_name, middle_name, suffix, birthdate, age, province, city, barangay, purok, subdivision, house_no, mobile_number, image_url, gender, id_type) VALUES (?,?,?,?, DATE(?) ,?,?,?,?,?,?,?,?,?,?,?);';
      $statement = $this->connection->prepare($sql);
      $statement->bind_param('sssssissssssssss', $patient->first_name, $patient->last_name, $patient->middle_name, $patient->suffix, $patient->birthdate, $patient->age, $patient->province, $patient->city, $patient->barangay, $patient->purok, $patient->subdivision, $patient->house_no, $patient->mobile_number, $patient->image_url, $patient->gender, $patient->id_type);
      $statement->execute();
      $id = $this->connection->insert_id;
      $result = $this->connection->query("SELECT id FROM patient ORDER BY id DESC LIMIT 1");
      $row = $result->fetch_assoc();
      $patient->id = $row["id"];

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
    $statement->bind_param('s', $patientId);

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
    $sql = "UPDATE patient SET first_name = ?, middle_name = ?, last_name = ?, suffix = ?, birthdate = DATE(?), age = ?, province = ?, city = ?, barangay = ?, purok = ?, mobile_number = ?, image_url = ?, gender = ?, id_type =? WHERE id = ?;";
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('sssssisssssssss', $patient->first_name, $patient->middle_name, $patient->last_name, $patient->suffix, $patient->birthdate, $patient->age, $patient->province, $patient->city, $patient->barangay, $patient->purok, $patient->mobile_number, $patient->image_url, $patient->gender, $patient->id_type, $patient->id);
    $statement->execute();

    $this->close();
  }
  public function getPatientCountWithRequest(string $time)
  {
    $this->checkConnection();

    switch ($time) {
      case 'today':
        $sql = "SELECT COUNT(DISTINCT patient_id) as count FROM request WHERE DATE(request_date) = CURDATE()";
        break;
      case 'month':
        $sql = "SELECT COUNT(DISTINCT patient_id) as count FROM request WHERE MONTH(request_date) = MONTH(CURRENT_DATE()) AND YEAR(request_date) = YEAR(CURRENT_DATE())";
        break;
      case 'year':
        $sql = "SELECT COUNT(DISTINCT patient_id) as count FROM request WHERE YEAR(request_date) = YEAR(CURRENT_DATE())";
        break;
      default:
        throw new Exception("Invalid time parameter. Accepted values are 'today', 'month', or 'year'.");
    }

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_assoc();
      $this->close();
      return $data['count'];
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
}
