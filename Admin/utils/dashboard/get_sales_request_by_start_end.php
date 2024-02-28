<?php
require_once __DIR__ . '/../../../Models/RequestModel.php';
header("Content-Type: application/json");

$requestModel = new RequestModel();
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$requests = $requestModel->getSalesRequestByMonthandStartAndEndDate($start_date, $end_date);
echo json_encode(["salesRequests" => $requests]);
