<?php
require_once __DIR__ . '/../../../Models/ServicesModel.php';
header("Content-Type: application/json");


$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$serviceModel = new ServicesModel();
$services = $serviceModel->getServiceSalesByStartAndEndDate($start_date, $end_date);
echo json_encode(["services" => $services]);
