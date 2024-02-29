
<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../../Models/RequestModel.php';

session_start();

if (!isset($_SESSION['id'])) {
  header('Location: login.php');
}



// Assuming the JSON data is posted as 'json_data'
$jsonData = json_decode(file_get_contents("php://input"), true);
$requestModel = new RequestModel();
$id = $jsonData['id'];
$model = $jsonData['object'];

switch ($model) {
  case 'appointment':
    require_once __DIR__ . '/../../Models/AppointmentModel.php';
    $appointmentModel = new AppointmentModel();
    $appointmentModel->deleteAppointment($id);
    break;

  case 'request':
    $requestModel = new RequestModel();
    $requestModel->deleteRequest($id);

    break;
  case 'patient':
    require_once __DIR__ . '/../../Models/PatientModel.php';
    $patientModel = new PatientModel();
    $patientModel->deletePatient($id);
    $requestModel = new RequestModel();
    $requests = $requestModel->getRequestFromPatientId($id);
    foreach ($requests as $request) {
      $requestModel = new RequestModel();
      $requestModel->deleteRequest($request->id);
    }
    break;
  case 'user':
    require_once __DIR__ . '/../../Models/UserModel.php';
    $userModel = new UserModel();
    $userModel->deleteUserById($id);
    break;
}

print_r('Results Updated');
?>