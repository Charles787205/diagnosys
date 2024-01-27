<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

require_once __DIR__ . '/../../../Objects/Services.php';
require_once __DIR__ . '/../../../Models/ServicesModel.php';

$jsonData = json_decode(file_get_contents('php://input'), true);
//$service = new Services();

$name = $jsonData['package_name'];
$services = $jsonData['services'];
$serviceModel = new ServicesModel();

$service_ids = [];
$total_price = intVal($jsonData['price']);
foreach ($services as $service) {
  $service_ids[] = intval($service);
}


$isSuccess = $serviceModel->addPackageServices($service_ids, $name, $total_price);
if ($isSuccess) {
  echo json_encode(["message" => "Success"]);
} else {
  http_response_code(400);
  echo json_encode(["error" => json_encode($service_ids)]);
}
