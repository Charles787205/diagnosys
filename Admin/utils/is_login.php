<?php 

session_start();
if(!isset($_SESSION['id'])){
  header('Location: login.php');
}else{
  require_once __DIR__ . '/../../Models/EmployeeModel.php';
  $employeeModel = new EmployeeModel();
if(!$employeeModel->getEmployeeById($_SESSION['id'])){
  header('Location: login.php');
}
  
}
?>