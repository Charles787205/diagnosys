<?php
require_once __DIR__ . '/../../../Models/AppointmentModel.php';
header("Content-Type: application/json");



$time = $_GET['time'];
$appointmentModel = new AppointmentModel();
$count = $appointmentModel->getAppointmentCount($time);

echo json_encode(["count" => $count]);
