<?php
require_once __DIR__ . '/../../../Models/PatientModel.php';
header("Content-Type: application/json");



$time = $_GET['time'];
$requestModel = new PatientModel();
$count = $requestModel->getPatientCountWithRequest($time);

echo json_encode(["count" => $count]);
