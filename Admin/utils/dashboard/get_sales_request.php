<?php
require_once __DIR__ . '/../../../Models/RequestModel.php';
header("Content-Type: application/json");




$requestModel = new RequestModel();
if (isset($_GET['start_time']) && isset($_GET['end_time'])) {
  $start_date = $_GET['start_time'];
  $end_date = $_GET['end_time'];
  $requests = $requestModel->getSalesRequestByMonthandStartAndEndDate($start_date, $end_date);
  echo json_encode(["salesRequests" => $requests]);
} else {

  $requests = $requestModel->getSalesRequestByMonth();
  echo json_encode(["salesRequests" => $requests]);
}
