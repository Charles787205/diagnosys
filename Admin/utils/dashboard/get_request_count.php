<?php
require_once __DIR__ . '/../../../Models/RequestModel.php';
header("Content-Type: application/json");



$time = $_GET['time'];
$requestModel = new RequestModel();
$count = $requestModel->getRequestCount($time);

echo json_encode(["count" => $count]);
