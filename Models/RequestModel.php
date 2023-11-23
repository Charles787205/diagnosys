<?php
require_once 'Database.php';
require_once '../Objects/Request.php';
require_once 'PatientModel.php';
require_once 'ServicesModel.php';
require_once '../Objects/Patient.php';
require_once '../Objects/Services.php';

class RequestModel extends Database {

  public function createRequest(Request $request){
    $patientModel = new PatientModel();
    $request->patient = $patientModel->getOrCreatePatient($request->patient);
    $sql = 'INSERT INTO request (user_id, patient_id, total) VALUES (?,?,?)';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('iid', $request->user_id, $request->patient->id, $request->total);
    if($statement->execute()){
      if(count($request->services) != 0){

        $id = $this->connection->insert_id;
        $sql = 'INSERT INTO request_services (request_id, service_id) VALUES ';
        for($i=0; $i< count($request->services); $i++){
          $sql .= '('. $id . ',' . $request->services[$i]->id . ')';
          if( $i < count($request->services)-1){
            $sql .= ',';
          }
        }
        $sql .= ';';
        
        $statement = $this->connection->prepare($sql);
        $statement->execute();
      }
    }
    $this->connection->close();
  }

  public function getRequestFromUserId($id){
    $sql = 'SELECT patient.id AS patient_id, patient.first_name, patient.last_name, patient.birthdate, patient.age, patient.province, patient.city, patient.barangay, patient.purok, patient.mobile_number, patient.image_url, request.id AS request_id, request.status, request.request_date, request.total FROM patient JOIN request ON patient.id = request.patient_id WHERE
    request.user_id = ?;';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);
    $servicesModel = new ServicesModel();
    if($statement->execute()){
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $requests = array();
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

          //request
          $request = new Request();
          $request->id = $d['request_id'];
          $request->status = $d['status'];
          $request->request_date = $d['request_date'];
          $request->total = $d['total'];
          $request->patient = $patient;
          $requests[] = $request;
        }
        foreach($requests as $r){
          $r->services = $servicesModel->getServicesByRequestId($r->id);
        }
        $this->connection->close();
        return $requests;
    } else {
        // Handle the case where the query execution fails
        return false;
    }

  }
  public function getRequestFromPatientId($id){
    $sql = 'SELECT * FROM request WHERE patient_id = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);
    $servicesModel = new ServicesModel();
    
    if($statement->execute()){
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        

        $requests = array();
        foreach($data as $d){

          //Patient
      

          //request
          $request = new Request();
          $request->id = $d['id'];
          $request->user_id = $d['user_id'];
          $request->status = $d['status'];
          $request->request_date = $d['request_date'];
          $request->total = $d['total'];
          $requests[] = $request;
        }
        
        foreach($requests as $r){
          $r->services = $servicesModel->getServicesByRequestId($r->id);
        }
        $servicesModel->close();
        return $requests;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  public function getPendingRequests() {
    $sql = 'SELECT * FROM request WHERE status = "Pending"';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $requests = array();
        foreach ($data as $d) {
            $request = new Request();
            $request->id = $d['id'];
            $request->user_id = $d['user_id'];
            $request->patient_id = $d['patient_id'];
            $request->status = $d['status'];
            $request->request_date = $d['request_date'];
            $request->total = $d['total'];
            $requests[] = $request;
        }
        foreach($requests as $request){
          $patientModel = new PatientModel();
          $servicesModel = new ServicesModel();
          $request->patient = $patientModel->getPatientById($request->patient_id);
          $request->services = $servicesModel->getServicesByRequestId($request->id);
        }
        $this->connection->close();
        return $requests;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  public function getRequestById($id) {
    $sql = 'SELECT * FROM request WHERE id = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $request = $result->fetch_object('Request');
        $statement->close();
        $servicesModel = new ServicesModel();
        $patientModel = new PatientModel();
        $request->patient = $patientModel->getPatientById($request->patient_id);
        $request->services = $servicesModel->getServicesByRequestId($request->id);
       $this->connection->close(); 
        return $request;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }

  public function getRequestsByStatus($status) {
    $sql = 'SELECT * FROM request WHERE status=?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('s', $status);
    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $requests = array();
        foreach ($data as $d) {
            $request = new Request();
            $request->id = $d['id'];
            $request->user_id = $d['user_id'];
            $request->patient_id = $d['patient_id'];
            $request->status = $d['status'];
            $request->request_date = $d['request_date'];
            $request->total = $d['total'];
            $requests[] = $request;
        }
        foreach($requests as $request){
          $patientModel = new PatientModel();
          $servicesModel = new ServicesModel();
          $request->patient = $patientModel->getPatientById($request->patient_id);
          $request->services = $servicesModel->getServicesByRequestId($request->id);
        }
        $this->connection->close();
        return $requests;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  public function getRequests() {
    $sql = 'SELECT * FROM request';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $requests = array();
        foreach ($data as $d) {
            $request = new Request();
            $request->id = $d['id'];
            $request->user_id = $d['user_id'];
            $request->patient_id = $d['patient_id'];
            $request->status = $d['status'];
            $request->request_date = $d['request_date'];
            $request->total = $d['total'];
            $requests[] = $request;
        }
        foreach($requests as $request){
          $patientModel = new PatientModel();
          $servicesModel = new ServicesModel();
          $request->patient = $patientModel->getPatientById($request->patient_id);
          $request->services = $servicesModel->getServicesByRequestId($request->id);
        }
        $this->connection->close();
        return $requests;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }

  function updateRequestStatus($requestId, $status) {
    
    $sql = 'UPDATE request SET status = ? WHERE id = ?';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('si', $status, $requestId);

    if ($statement->execute()) {
      $this->connection->close();
        echo "Request status updated successfully";
    } else {
        echo "Error updating request status";
    }
  }

  function updateResult($data) {
        // Assuming $data is an array with request_id, service_id, result, and normal_value keys
        foreach ($data as $item) {
            $requestId = $item['request_id'];
            $serviceId = $item['service_id'];
            $result = $item['result'];
            $normalValue = $item['normal_value'];

            // Assuming you have a function to update the result in your database
            $this->updateResultInDatabase($requestId, $serviceId, $result, $normalValue);
        }
    }

    // Function to update the result in the database
    private function updateResultInDatabase($requestId, $serviceId, $result, $normalValue) {
        $sql = 'UPDATE request_services SET result = ?, normal_value = ? WHERE request_id = ? AND service_id = ?';
        $statement = $this->connection->prepare($sql);
        $statement->bind_param('ssii', $result, $normalValue, $requestId, $serviceId);

        if ($statement->execute()) {
            
            echo "Result updated successfully";
        } else {
            echo "Error updating result";
        }
    }
    public function getApprovedRequestToday() {
    $sql = 'SELECT * FROM request WHERE status = "Approved" AND DATE(request_date) = CURDATE()';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $requests = array();
        foreach ($data as $d) {
            $request = new Request();
            $request->id = $d['id'];
            $request->user_id = $d['user_id'];
            $request->patient_id = $d['patient_id'];
            $request->status = $d['status'];
            $request->request_date = $d['request_date'];
            $request->total = $d['total'];

            // Include patient and services information
            $patientModel = new PatientModel();
            $servicesModel = new ServicesModel();
            $request->patient = $patientModel->getPatientById($request->patient_id);
            $request->services = $servicesModel->getServicesByRequestId($request->id);

            $requests[] = $request;
        }

        $this->connection->close();
        return $requests;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  } 
  public function getApprovedRequestTodayByUserId($userId) {
    $sql = 'SELECT * FROM request WHERE user_id = ? AND status = "Approved" AND DATE(request_date) = CURDATE()';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $userId);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $requests = array();
        foreach ($data as $d) {
            $request = new Request();
            $request->id = $d['id'];
            $request->user_id = $d['user_id'];
            $request->patient_id = $d['patient_id'];
            $request->status = $d['status'];
            $request->request_date = $d['request_date'];
            $request->total = $d['total'];

            // Include patient and services information
            $patientModel = new PatientModel();
            $servicesModel = new ServicesModel();
            $request->patient = $patientModel->getPatientById($request->patient_id);
            $request->services = $servicesModel->getServicesByRequestId($request->id);

            $requests[] = $request;
        }

        $this->connection->close();
        return $requests;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }public function getRequestToday() {
    $sql = 'SELECT * FROM request WHERE DATE(request_date) = CURDATE()';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        $requests = array();
        foreach ($data as $d) {
            $request = new Request();
            $request->id = $d['id'];
            $request->user_id = $d['user_id'];
            $request->patient_id = $d['patient_id'];
            $request->status = $d['status'];
            $request->request_date = $d['request_date'];
            $request->total = $d['total'];

            // Include patient and services information
            $patientModel = new PatientModel();
            $servicesModel = new ServicesModel();
            $request->patient = $patientModel->getPatientById($request->patient_id);
            $request->services = $servicesModel->getServicesByRequestId($request->id);

            $requests[] = $request;
        }

        $this->connection->close();
        return $requests;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  } 



  
  

  
  
}


