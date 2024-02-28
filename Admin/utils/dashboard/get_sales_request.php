<?php
require_once __DIR__ . '/../../../Models/RequestModel.php';
header("Content-Type: application/json");




$requestModel = new RequestModel();
$requests = $requestModel->getSalesRequestByMonth();

echo json_encode(["salesRequests" => $requests]);
