<?php
require_once 'Database.php';
require_once '../Objects/Appointment.php';
require_once 'PatientModel.php';
require_once '../Objects/Patient.php';
require_once '../Objects/Services.php';
require_once 'ServicesModel.php';

class AppointmentModel extends Database {

  public function createAppointment(Appointment $appointment){
    $patientModel = new PatientModel();
    $appointment->patient = $patientModel->getOrCreatePatient($appointment->patient);
    $sql = 'INSERT INTO appointment (user_id, patient_id, total,appointment_date) VALUES (?,?,?,DATE(?))';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('iids', $appointment->user_id, $appointment->patient->id, $appointment->total, $appointment->appointment_date);
    if($statement->execute()){
      if(count($appointment->services) != 0){

        $id = $this->connection->insert_id;
        $sql = 'INSERT INTO appointment_services VALUES ';
        for($i=0; $i< count($appointment->services); $i++){
          $sql .= '('. $id . ',' . $appointment->services[$i]->id . ')';
          if( $i < count($appointment->services)-1){
            $sql .= ',';
          }
        }
        $sql .= ';';
        
        $statement = $this->connection->prepare($sql);
        $statement->execute();
      }
    }
  }

  public function getAppointmentFromUserId($id){
    $sql = 'SELECT patient.id AS patient_id, patient.first_name, patient.last_name, patient.birthdate, patient.age, patient.province, patient.city, patient.barangay, patient.purok, patient.mobile_number, patient.image_url, appointment.id AS appointment_id, appointment.status, appointment.appointment_date, appointment.total FROM patient JOIN appointment ON patient.id = appointment.patient_id WHERE
    appointment.user_id = ?;';

    $servicesModel = new ServicesModel();
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if($statement->execute()){
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $appointments = array();
        foreach($data as $d){

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
          $appointment->patient = $patient;
          $appointments[] = $appointment;
        }
        foreach($appointments as $r){
          $r->services = $servicesModel->getServicesByAppointmentId($r->id);
        }
        return $appointments;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  public function getAppointmentFromPatientId($id){
    $sql = 'SELECT * FROM appointment WHERE patient_id = ?';

    $servicesModel = new ServicesModel();
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if($statement->execute()){
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $appointments = array();
        foreach($data as $d){

          
          //appointment
          $appointment = new Appointment();
          $appointment->id = $d['id'];
          $appointment->user_id = $d['user_id'];
          $appointment->status = $d['status'];
          $appointment->appointment_date = $d['appointment_date'];
          $appointment->total = $d['total'];
          $appointments[] = $appointment;
        }
        foreach($appointments as $r){
          $r->services = $servicesModel->getServicesByAppointmentId($r->id);
        }
        return $appointments;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  public function getAppointments() {
    $sql = 'SELECT * FROM appointment';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

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
        $patientModel = new PatientModel();
        $servicesModel = new ServicesModel();
        foreach($appointments as $appointment){
          $appointment->patient = $patientModel->getPatientById($appointment->patient_id);
          $appointment->services = $servicesModel->getServicesByAppointmentId($appointment->id);
        }
        $this->connection->close();
        return $appointments;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  public function getAppointmentById($id) {
    $sql = 'SELECT * FROM appointment WHERE id = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $appointment = $result->fetch_object('Appointment');
        $statement->close();
        $servicesModel = new ServicesModel();
        $appointment->services = $servicesModel->getServicesByAppointmentId($appointment->id);
        $this->connection->close();
        return $appointment;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  function updateAppointmentStatus($appointmentId, $status) {
    
    $sql = 'UPDATE appointment SET status = ? WHERE id = ?';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('si', $status, $appointmentId);

    if ($statement->execute()) {
      $this->connection->close();
        echo "Appointment status updated successfully";
    } else {
        echo "Error updating appointment status";
    }
  }
  


}