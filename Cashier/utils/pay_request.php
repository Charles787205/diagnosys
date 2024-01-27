<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../../Models/RequestModel.php';
require_once __DIR__ . '/../../Objects/Request.php';

$jsonData = json_decode(file_get_contents("php://input"), true);
$requestModel = new RequestModel();


$id = $jsonData['id'];
$payment = $jsonData['payment'];
$insurance = $jsonData['insurance'];
$company = $jsonData['company'];
$account_number = $jsonData['account_number'];
$requestModel->payRequest($payment, $id, $insurance, $company, $account_number);

echo json_encode('Success');
