<?php
require_once 'Database.php';
require_once __DIR__ . '/../Objects/Appointment.php';
require_once 'PatientModel.php';
require_once __DIR__ . '/../Objects/Patient.php';
require_once __DIR__ . '/../Objects/Services.php';
require_once 'ServicesModel.php';

class AppointmentModel extends Database
{

  public function createAppointment(Appointment $appointment)
  {
    $this->checkConnection();
    $patientModel = new PatientModel();
    $appointment->patient = $patientModel->getOrCreatePatient($appointment->patient);
    $sql = 'INSERT INTO appointment (user_id, patient_id, total,appointment_date) VALUES (?,?,?,DATE(?))';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('iids', $appointment->user_id, $appointment->patient->id, $appointment->total, $appointment->appointment_date);
    if ($statement->execute()) {
      if (count($appointment->services) != 0) {

        $id = $this->connection->insert_id;
        $sql = 'INSERT INTO appointment_services VALUES ';
        for ($i = 0; $i < count($appointment->services); $i++) {
          $sql .= '(' . $id . ',' . $appointment->services[$i]->id . ')';
          if ($i < count($appointment->services) - 1) {
            $sql .= ',';
          }
        }
        $sql .= ';';

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $this->close();
      }
    }
  }

  public function getAppointmentFromUserId($id)
  {
    $sql = 'SELECT patient.id AS patient_id, patient.first_name, patient.last_name, patient.birthdate, patient.age, patient.province, patient.city, patient.barangay, patient.purok, patient.mobile_number, patient.image_url, appointment.id AS appointment_id,appointment.comment, appointment.status, appointment.appointment_date, appointment.total FROM patient JOIN appointment ON patient.id = appointment.patient_id WHERE
    appointment.user_id = ?;';
    $this->checkConnection();
    $servicesModel = new ServicesModel();
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $appointments = array();
      foreach ($data as $d) {

        //Patient
        $patient = new Patient();
        $patient->id = $d['patient_id'];
        $patient->first_name = $d['first_name'];
        $patient->last_name = $d['last_name'];
        $patient->birthdate = $d['birthdate'];
        $patient->age = $d['age'];
        $patient->province = $d['province'];
        $patient->city = $d['city'];
        $patient->barangay = $d['barangay'];
        $patient->purok = $d['purok'];
        $patient->mobile_number = $d['mobile_number'];
        $patient->image_url = $d['image_url'];

        //appointment
        $appointment = new Appointment();
        $appointment->id = $d['appointment_id'];
        $appointment->status = $d['status'];
        $appointment->appointment_date = $d['appointment_date'];
        $appointment->total = $d['total'];
        $appointment->comment = $d['comment'];
        $appointment->patient = $patient;
        $appointments[] = $appointment;
      }
      foreach ($appointments as $r) {
        $r->services = $servicesModel->getServicesByAppointmentId($r->id);
      }
      $this->close();
      return $appointments;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getAppointmentFromPatientId($id)
  {
    $sql = 'SELECT * FROM appointment WHERE patient_id = ?';
    $this->checkConnection();
    $servicesModel = new ServicesModel();
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $appointments = array();
      foreach ($data as $d) {


        //appointment
        $appointment = new Appointment();
        $appointment->id = $d['id'];
        $appointment->user_id = $d['user_id'];
        $appointment->status = $d['status'];
        $appointment->appointment_date = $d['appointment_date'];
        $appointment->total = $d['total'];
        $appointments[] = $appointment;
      }
      foreach ($appointments as $r) {
        $r->services = $servicesModel->getServicesByAppointmentId($r->id);
      }
      $this->close();
      return $appointments;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getAppointments()
  {
    $sql = 'SELECT * FROM appointment';
    $this->checkConnection();
    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $appointments = array();
      foreach ($data as $d) {
        $appointment = new Appointment();
        $appointment->id = $d['id'];
        $appointment->user_id = $d['user_id'];
        $appointment->patient_id = $d['patient_id'];
        $appointment->status = $d['status'];
        $appointment->appointment_date = $d['appointment_date'];
        $appointment->total = $d['total'];
        $appointments[] = $appointment;
      }
      foreach ($appointments as $appointment) {
        $patientModel = new PatientModel();
        $servicesModel = new ServicesModel();
        $appointment->patient = $patientModel->getPatientById($appointment->patient_id);
        $appointment->services = $servicesModel->getServicesByAppointmentId($appointment->id);
      }

      return $appointments;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getAppointmentById($id)
  {
    $sql = 'SELECT * FROM appointment WHERE id = ?';
    $this->checkConnection();
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $appointment = $result->fetch_object('Appointment');
      $this->close();
      $servicesModel = new ServicesModel();
      $appointment->services = $servicesModel->getServicesByAppointmentId($appointment->id);

      return $appointment;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  function updateAppointmentStatus($appointmentId, $status)
  {
    $this->checkConnection();
    $sql = 'UPDATE appointment SET status = ? WHERE id = ?';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('si', $status, $appointmentId);

    if ($statement->execute()) {
      $this->close();
      echo "Appointment status updated successfully";
    } else {
      echo "Error updating appointment status";
    }
  }
  function deleteAppointment($appointment_id)
  {
    $this->checkConnection();
    $sql = "DELETE FROM appointment WHERE id = $appointment_id;";
    $statement = $this->connection->prepare($sql);
    $statement->execute();
    $this->close();
  }

  public function rejectAppointment($appointmentId, $comment)
  {
    $this->checkConnection();
    $sqlUpdate = 'UPDATE appointment SET status = "Reject", comment = ? WHERE id = ?';
    $statementUpdate = $this->connection->prepare($sqlUpdate);
    $statementUpdate->bind_param('si', $comment, $appointmentId);

    if ($statementUpdate->execute()) {
      $this->close();
      echo "Appointment rejected successfully.";
    } else {
      echo "Error rejecting appointment.";
    }
  }
  public function getApprovedFutureAppointments()
  {
    $sql = 'SELECT * FROM appointment WHERE status = "Approved" AND appointment_date >= CURDATE()';
    $this->checkConnection();
    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $appointments = array();
      foreach ($data as $d) {
        $appointment = new Appointment();
        $appointment->id = $d['id'];
        $appointment->user_id = $d['user_id'];
        $appointment->patient_id = $d['patient_id'];
        $appointment->status = $d['status'];
        $appointment->appointment_date = $d['appointment_date'];
        $appointment->total = $d['total'];
        $appointments[] = $appointment;
      }

      foreach ($appointments as $appointment) {
        $patientModel = new PatientModel();
        $appointment->patient = $patientModel->getPatientById($appointment->patient_id);
      }
      foreach ($appointments as $appointment) {
        $servicesModel = new ServicesModel();
        $appointment->services = $servicesModel->getServicesByAppointmentId($appointment->id);
      }


      return $appointments;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }

  public function getAppointmentsCreatedToday()
  {
    $sql = 'SELECT * FROM appointment WHERE DAY(datetime_created) = DAY(CURDATE())';
    $this->checkConnection();
    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $appointments = array();
      foreach ($data as $d) {
        $appointment = new Appointment();
        $appointment->id = $d['id'];
        $appointment->user_id = $d['user_id'];
        $appointment->patient_id = $d['patient_id'];
        $appointment->status = $d['status'];
        $appointment->appointment_date = $d['appointment_date'];
        $appointment->total = $d['total'];
        $appointments[] = $appointment;
      }

      foreach ($appointments as $appointment) {
        $patientModel = new PatientModel();
        $appointment->patient = $patientModel->getPatientById($appointment->patient_id);
      }
      foreach ($appointments as $appointment) {
        $servicesModel = new ServicesModel();
        $appointment->services = $servicesModel->getServicesByAppointmentId($appointment->id);
      }


      return $appointments;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getAppointmentCount($time)
  {

    $this->checkConnection();

    switch ($time) {
      case 'today':
        $sql = "SELECT COUNT(*) as count FROM appointment WHERE DATE(appointment_date) = CURDATE()";
        break;
      case 'month':
        $sql = "SELECT COUNT(*) as count FROM appointment WHERE MONTH(appointment_date) = MONTH(CURRENT_DATE()) AND YEAR(appointment_date) = YEAR(CURRENT_DATE())";
        break;
      case 'year':
        $sql = "SELECT COUNT(*) as count FROM appointment WHERE YEAR(appointment_date) = YEAR(CURRENT_DATE())";
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
