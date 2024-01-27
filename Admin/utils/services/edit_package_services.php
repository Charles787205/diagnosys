<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

require_once __DIR__ . '/../../../Objects/Services.php';
require_once __DIR__ . '/../../../Models/ServicesModel.php';

$jsonData = json_decode(file_get_contents('php://input'), true);
$service = new Services();


$serviceModel = new ServicesModel();

$isSuccess = $serviceModel->editPackageService($jsonData);

if ($isSuccess) {
  echo json_encode(["message" => "Success"]);
} else {
  http_response_code(400);
  echo json_encode(["error" => "Failed to update service"]);
}
