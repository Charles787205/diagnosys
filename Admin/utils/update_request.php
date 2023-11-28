<?php 
require_once __DIR__ . '/../../Models/RequestModel.php';
header("Access-Control-Allow-Origin: *");
session_start();

if(!isset($_SESSION['id'])){
  header('Location: login.php');
}



// Assuming the JSON data is posted as 'json_data'
$jsonData = json_decode(file_get_contents("php://input"), true);
$status = $jsonData['status'];
$request_id = $jsonData['id'];
$requestModel = new RequestModel();
if($status == Request::REJECT){
  $comment = $jsonData['comment'];
  $requestModel->rejectRequest($request_id, $comment);
}else{
  $requestModel->updateRequestStatus($request_id,$status);
}