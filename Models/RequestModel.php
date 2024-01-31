<?php
require_once 'Database.php';
require_once __DIR__ . '/../Objects/Request.php';
require_once 'PatientModel.php';
require_once 'ServicesModel.php';
require_once __DIR__ . '/../Objects/Patient.php';
require_once __DIR__ . '/../Objects/Services.php';

class RequestModel extends Database
{

  public function createRequest(Request $request)
  {
    $this->checkConnection();
    $patientModel = new PatientModel();
    $request->patient = $patientModel->getOrCreatePatient($request->patient);
    $sql = 'INSERT INTO request (user_id, patient_id, total) VALUES (?,?,?)';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('isd', $request->user_id, $request->patient->id, $request->total);
    if ($statement->execute()) {
      if (count($request->services) != 0) {

        $id = $this->connection->insert_id;
        $sql = 'INSERT INTO request_services (request_id, service_id) VALUES ';
        for ($i = 0; $i < count($request->services); $i++) {
          $sql .= '(' . $id . ',' . $request->services[$i]->id . ')';
          if ($i < count($request->services) - 1) {
            $sql .= ',';
          }
        }
        $sql .= ';';

        $statement = $this->connection->prepare($sql);
        $statement->execute();
      }
    }
  }

  public function getRequestFromUserId($id)
  {
    $this->checkConnection();
    $sql = 'SELECT patient.id AS patient_id, patient.first_name, patient.last_name, patient.birthdate, patient.age, patient.province, patient.city, patient.barangay, patient.purok, patient.mobile_number, patient.image_url,request.comment, request.id AS request_id, request.status, request.request_date, request.total FROM patient JOIN request ON patient.id = request.patient_id WHERE
    request.user_id = ?;';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $requests = array();
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

        //request
        $request = new Request();
        $request->id = $d['request_id'];
        $request->status = $d['status'];
        $request->request_date = $d['request_date'];
        $request->total = $d['total'];
        $request->comment = $d['comment'];
        $request->patient = $patient;
        $requests[] = $request;
      }
      foreach ($requests as $r) {
        $servicesModel = new ServicesModel();
        $r->services = $servicesModel->getServicesByRequestId($r->id);
      }

      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getRequestFromPatientId($id)
  {
    $this->checkConnection();
    $sql = 'SELECT * FROM request WHERE patient_id = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('s', $id);


    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);


      $requests = array();
      foreach ($data as $d) {

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

      foreach ($requests as $r) {
        $servicesModel = new ServicesModel();
        $r->services = $servicesModel->getServicesByRequestId($r->id);
      }

      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getPendingRequests()
  {
    $this->checkConnection();
    $sql = 'SELECT * FROM request WHERE status = "Pending"';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

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
      foreach ($requests as $request) {
        $patientModel = new PatientModel();
        $servicesModel = new ServicesModel();
        $request->patient = $patientModel->getPatientById($request->patient_id);
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }

      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getRequestById($id)
  {
    $this->checkConnection();
    $sql = 'SELECT r.*, p.amount, p.account_number, p.insurance, p.company, p.date_paid 
            FROM request r
            LEFT JOIN payment p ON r.payment = p.id
            WHERE r.id = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $request = $result->fetch_object('Request');
      $this->close();

      // Assuming you have Patient and Services models
      $patientModel = new PatientModel();
      $request->patient = $patientModel->getPatientById($request->patient_id);
      $servicesModel = new ServicesModel();
      $request->services = $servicesModel->getServicesByRequestId($request->id);

      // Add payment date to Request object
      $request->payment_date = $request->date_paid; // Assuming "date_paid" is in Request object

      return $request;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }


  public function getRequestsByStatus($status)
  {
    $this->checkConnection();
    $sql = 'SELECT * FROM request WHERE status=?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('s', $status);
    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $requests = array();
      foreach ($data as $d) {
        $request = new Request();
        $request->id = $d['id'];
        $request->user_id = $d['user_id'];
        $request->patient_id = $d['patient_id'];
        $request->status = $d['status'];
        $request->request_date = $d['request_date'];
        $request->total = $d['total'];
        $request->result_date = $d['result_date'];
        $requests[] = $request;
      }
      foreach ($requests as $request) {
        $servicesModel = new ServicesModel();
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }
      foreach ($requests as $request) {
        $patientModel = new PatientModel();
        $request->patient = $patientModel->getPatientById($request->patient_id);
      }

      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getRequests()
  {
    $this->checkConnection();
    $sql = 'SELECT * FROM request';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $requests = array();
      foreach ($data as $d) {
        $request = new Request();
        $request->fill($d);
        $requests[] = $request;
      }
      foreach ($requests as $request) {
        $patientModel = new PatientModel();
        $servicesModel = new ServicesModel();
        $request->patient = $patientModel->getPatientById($request->patient_id);
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }

      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }

  function updateRequestStatus($requestId, $status, $payment = 0)
  {
    $this->checkConnection();
    if ($status == Request::PAID || $status == Request::APPROVED) {
      $sql = 'UPDATE request SET status = ?, request_date= NOW(), payment=? WHERE id = ?';
    } else {

      $sql = 'UPDATE request SET status = ?, payment=? WHERE id = ?';
    }
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('sdi', $status, $payment,  $requestId);

    if ($statement->execute()) {

      echo "Request status updated successfully";
    } else {
      echo "Error updating request status";
    }
  }

  function updateResult($data)
  {
    $this->checkConnection();
    foreach ($data as $item) {
      $requestId = $item['request_id'];
      $serviceId = $item['service_id'];
      $test = $item['test'];
      $result = $item['result'];
      $normalValue = $item['normal_value'];

      $this->updateResultInDatabase($requestId, $serviceId, $result, $normalValue, $test);
    }
    $sql = "UPDATE `request` SET `result_date` = NOW() WHERE `id` = ?";
    $statement = $this->connection->prepare($sql);


    $statement->bind_param("i", $requestId);

    $statement->execute();
  }


  // Function to update the result in the database
  private function updateResultInDatabase($requestId, $serviceId, $result, $normalValue, $test)
  {

    $this->checkConnection();
    $sql = 'UPDATE request_services SET result = ?,  test = ? WHERE request_id = ? AND service_id = ?';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('ssii', $result, $test, $requestId, $serviceId);

    if ($statement->execute()) {

      echo "Result updated successfully";
    } else {
      echo "Error updating result";
    }
  }
  public function getApprovedRequestToday()
  {
    $this->checkConnection();
    $sql = 'SELECT * FROM request WHERE status = "Approved" AND DATE(request_date) = CURDATE()';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $requests = array();
      foreach ($data as $d) {
        $request = new Request();
        $request->fill($d);

        // Include patient and services information
        $patientModel = new PatientModel();
        $servicesModel = new ServicesModel();
        $request->patient = $patientModel->getPatientById($request->patient_id);
        $request->services = $servicesModel->getServicesByRequestId($request->id);

        $requests[] = $request;
      }


      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getApprovedRequestTodayByUserId($userId)
  {
    $this->checkConnection();
    $sql = 'SELECT requestTable.*, patientTable.* FROM request as requestTable JOIN patient as patientTable ON requestTable.patient_id = patientTable.id WHERE requestTable.user_id = ? AND requestTable.status = "Approved" AND DATE(requestTable.request_date) = CURDATE()';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $userId);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $requests = array();
      while ($row = $result->fetch_object()) {
        $request = new Request();
        $request->fill($row);
        $patient = new Patient();
        $patient->fill($row);
        $request->patient = $patient;
        $requests[] = $request;
      }
      $this->close();

      foreach ($requests as $request) {
        $servicesModel = new ServicesModel();
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }
      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }


  public function getRequestToday()
  {
    $this->checkConnection();
    $sql = 'SELECT requestTable.*, patientTable.* FROM request as requestTable JOIN patient as patientTable ON requestTable.patient_id = patientTable.id WHERE DATE(requestTable.request_date) = CURDATE()';

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $requests = array();
      while ($row = $result->fetch_object()) {
        $request = new Request();
        $request->fill($row);
        $patient = new Patient();
        $patient->fill($row);
        $request->patient = $patient;
        $requests[] = $request;
      }
      $this->close();

      foreach ($requests as $request) {
        $servicesModel = new ServicesModel();
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }
      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }


  function deleteRequest($request_id)
  {
    $this->checkConnection();
    $sql = "DELETE FROM request WHERE id = $request_id;";
    $statement = $this->connection->prepare($sql);
    $statement->execute();
  }


  public function getRequestTodayByStatus($status)
  {
    $this->checkConnection();
    $sql = 'SELECT * FROM request WHERE status = ? AND DATE(request_date) = CURDATE()';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('s', $status);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $requests = array();
      foreach ($data as $d) {
        $request = new Request();
        $request->fill($d);



        $requests[] = $request;
      }
      foreach ($requests as $request) {
        $patientModel = new PatientModel();
        $request->patient = $patientModel->getPatientById($request->patient_id);
      }
      foreach ($requests as $request) {
        $servicesModel = new ServicesModel();
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }


      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getRequestTodayByStatusAndUserId($status, $user_id)
  {
    $sql = 'SELECT * FROM request WHERE status = ? AND user_id = ? AND DATE(request_date) = CURDATE()';
    $this->checkConnection();
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('si', $status, $user_id);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $requests = array();
      foreach ($data as $d) {
        $request = new Request();
        $request->fill($d);

        // Include patient and services information

        $requests[] = $request;
      }



      foreach ($requests as $request) {
        $patientModel = new PatientModel();
        $request->patient = $patientModel->getPatientById($request->patient_id);
      }
      foreach ($requests as $request) {
        $servicesModel = new ServicesModel();
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }
      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }
  public function getRequestsByStatusAndUserId($status, $user_id)
  {
    $sql = 'SELECT * FROM request WHERE status = ? AND patient_id = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('si', $status, $user_id);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_all(MYSQLI_ASSOC);
      $this->close();

      $requests = array();
      foreach ($data as $d) {
        $request = new Request();
        $request->fill($d);


        // Include patient and services information

        $requests[] = $request;
      }



      foreach ($requests as $request) {
        $patientModel = new PatientModel();
        $request->patient = $patientModel->getPatientById($request->patient_id);
        $servicesModel = new ServicesModel();
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }
      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }

  public function getCommentByRequestId($requestId)
  {
    $sql = 'SELECT comment FROM request WHERE id = ?';
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $requestId);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $comment = $result->fetch_assoc()['comment'];
      $this->close();

      return $comment;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }


  public function rejectRequest($requestId, $comment)
  {

    $sqlUpdate = 'UPDATE request SET status = "Reject", comment = ? WHERE id = ?';
    $statementUpdate = $this->connection->prepare($sqlUpdate);
    $statementUpdate->bind_param('si', $comment, $requestId);

    if ($statementUpdate->execute()) {

      echo "Request rejected successfully.";
    } else {
      echo "Error rejecting request.";
    }
  }
  public function addServices($request)
  {
    $this->checkConnection();

    // Begin a transaction
    $this->connection->begin_transaction();

    try {
      // Delete existing services for the request
      $sql = "DELETE FROM request_services WHERE request_id = ?;";
      $statement = $this->connection->prepare($sql);
      $statement->bind_param('i', $request->id);
      $statement->execute();

      // Add new services to the request
      $sql = "INSERT INTO request_services (request_id, service_id) VALUES (?, ?);";
      $statement = $this->connection->prepare($sql);

      foreach ($request->services as $service) {
        $statement->bind_param('ii', $request->id, $service->id);
        $statement->execute();
      }

      // Update the total of the request
      $sql = "UPDATE request SET total = ? WHERE id = ?;";
      $statement = $this->connection->prepare($sql);
      $statement->bind_param('di', $request->total, $request->id);
      $statement->execute();

      // Commit the transaction
      $this->connection->commit();
    } catch (Exception $e) {
      // An error occurred; rollback the transaction
      $this->connection->rollback();

      // Re-throw the exception
      throw $e;
    } finally {
      $this->close();
    }
  }

  public function getRequestWithResult($user_id)
  {
    $sql = 'SELECT r.*, p.* FROM request r JOIN patient p ON r.patient_id = p.id WHERE r.user_id = ? AND r.result_date IS NOT NULL';
    $this->checkConnection();
    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $user_id);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $requests = array();
      while ($row = $result->fetch_object()) {
        $request = new Request();
        $request->fill($row);
        $patient = new Patient();
        $patient->fill($row);
        $request->patient = $patient;
        $requests[] = $request;
      }
      $this->close();

      foreach ($requests as $request) {
        $servicesModel = new ServicesModel();
        $request->services = $servicesModel->getServicesByRequestId($request->id);
      }
      return $requests;
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }

  public function getRequestCount(string $time)
  {
    $this->checkConnection();

    switch ($time) {
      case 'today':
        $sql = "SELECT COUNT(*) as count FROM request WHERE DATE(request_date) = CURDATE()";
        break;
      case 'month':
        $sql = "SELECT COUNT(*) as count FROM request WHERE MONTH(request_date) = MONTH(CURRENT_DATE()) AND YEAR(request_date) = YEAR(CURRENT_DATE())";
        break;
      case 'year':
        $sql = "SELECT COUNT(*) as count FROM request WHERE YEAR(request_date) = YEAR(CURRENT_DATE())";
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
  public function getPaidRequestTotal(string $time) // return [total:int, prev_total:int]
  {
    $this->checkConnection();

    switch ($time) {
      case 'today':
        $sql = "SELECT SUM(total) as total, 
                    (SELECT SUM(total) FROM request WHERE status = 'paid' AND DATE(request_date) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)) as prev_total 
                    FROM request WHERE status = 'paid' AND DATE(request_date) = CURDATE()";
        break;
      case 'month':
        $sql = "SELECT SUM(total) as total, 
                    (SELECT SUM(total) FROM request WHERE status = 'paid' AND MONTH(request_date) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) AND YEAR(request_date) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))) as prev_total 
                    FROM request WHERE status = 'paid' AND MONTH(request_date) = MONTH(CURRENT_DATE()) AND YEAR(request_date) = YEAR(CURRENT_DATE())";
        break;
      case 'year':
        $sql = "SELECT SUM(total) as total, 
                    (SELECT SUM(total) FROM request WHERE status = 'paid' AND YEAR(request_date) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 YEAR))) as prev_total 
                    FROM request WHERE status = 'paid' AND YEAR(request_date) = YEAR(CURRENT_DATE())";
        break;
      default:
        throw new Exception("Invalid time parameter. Accepted values are 'today', 'month', or 'year'.");
    }

    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
      $result = $statement->get_result();
      $data = $result->fetch_assoc();
      $this->close();
      return $data;  // Returns an associative array with 'total' and 'prev_total'
    } else {
      // Handle the case where the query execution fails
      return false;
    }
  }

  //new pay request function instead of the update request 
  function payRequest($amount, $requestId, $insurance, $company, $account_number)
  {
    $this->checkConnection();

    $this->connection->begin_transaction();

    try {
      $paymentStmt = $this->connection->prepare("INSERT INTO payment (amount, insurance, company, account_number) VALUES (?, ?, ?, ?)");
      $paymentStmt->bind_param('dsss', $amount, $insurance, $company, $account_number);
      $paymentStmt->execute();

      $paymentId = $paymentStmt->insert_id;

      $requestStmt = $this->connection->prepare("UPDATE request SET status = 'Paid', payment = ?, request_date = NOW() WHERE id = ?");
      $requestStmt->bind_param('ii', $paymentId, $requestId);
      $requestStmt->execute();

      $this->connection->commit();

      echo "Request paid successfully";
    } catch (Exception $e) {
      $this->connection->rollback();

      echo "Error processing payment: " . $e->getMessage();
    }
  }
  function updateRessult($data)
  {
    $this->checkConnection();
    foreach ($data as $item) {
      $requestId = $item['request_id'];
      $serviceId = $item['service_id'];
      $test = $item['test'];
      $result = $item['result'];
      $normalValue = $item['normal_value'];

      $this->updateResultInDatabase($requestId, $serviceId, $result, $normalValue, $test);
    }
    $sql = "UPDATE `request` SET `result_date` = NOW() WHERE `id` = ?";
    $statement = $this->connection->prepare($sql);


    $statement->bind_param("i", $requestId);

    $statement->execute();
  }
  function addResults($results)
  {
    $this->checkConnection();

    // Begin transaction for data integrity
    $this->connection->begin_transaction();

    try {
      foreach ($results as $item) {
        $requestId = $item['request_id'];
        $serviceId = $item['service_id'];
        $test = $item['test'];
        $result = $item['result'];

        // Insert the result into the request_result table
        $sql = 'INSERT INTO request_result (request_id, service_id, name, result) VALUES (?, ?, ?, ?)';
        $statement = $this->connection->prepare($sql);
        $statement->bind_param('iiss', $requestId, $serviceId, $test, $result);

        if (!$statement->execute()) {
          throw new Exception("Error adding result for request ID $requestId: " . $statement->error);
        }
      }

      // Update request date if any results were added
      if (!empty($results)) {
        $sql = "UPDATE `request` SET `result_date` = NOW() WHERE `id` = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param("i", $requestId); // Use the last request ID from the loop
        $statement->execute();
      }

      // Commit the transaction if all queries executed successfully
      $this->connection->commit();

      echo "Results added successfully";
    } catch (Exception $e) {
      // Rollback the transaction on error
      $this->connection->rollback();

      // Handle the error appropriately (e.g., log, throw exception, etc.)
      throw $e;  // Re-throw the exception for further handling
    }
  }
}
