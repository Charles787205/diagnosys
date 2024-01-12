<?php 
require_once __DIR__ . '/../../Models/AppointmentModel.php';
header("Access-Control-Allow-Origin: *");
session_start();

if(!isset($_SESSION['id'])){
  header('Location: login.php');
}



// Assuming the JSON data is posted as 'json_data'
$jsonData = json_decode(file_get_contents("php://input"), true);
$status = $jsonData['status'];
$appointment_id = $jsonData['id'];
$appointmentModel = new AppointmentModel();
if($status == Appointment::REJECT){
  $comment = $jsonData['comment'];
  $appointmentModel->rejectAppointment($appointment_id, $comment);
}else{
  $appointmentModel->updateAppointmentStatus($appointment_id,$status);
}
