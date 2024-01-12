<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../../Models/RequestModel.php';
require_once __DIR__ . '/../../Objects/Request.php';

$jsonData = json_decode(file_get_contents("php://input"), true);
$requestModel = new RequestModel();


$id = $jsonData['id'];
$payment = $jsonData['payment'];
$requestModel->updateRequestStatus($id, Request::PAID, $payment);

echo json_encode('Success');
