<?php

session_start();
header("Access-Control-Allow-Origin: *");

require __DIR__ . '/../../Models/RequestModel.php';
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
}



// Assuming the JSON data is posted as 'json_data'
$jsonData = json_decode(file_get_contents("php://input"), true);
$requestModel = new RequestModel();
$requestModel->addResults($jsonData);
print_r('Results Updated');
