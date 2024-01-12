<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../../Objects/Employee.php';
require_once __DIR__ . '/../../Models/EmployeeModel.php';
$jsonData = json_decode(file_get_contents("php://input"), true);
$employee = new Employee();
$employee->newEmployee(
    $jsonData['register_firstname'],
    $jsonData['register_lastname'],
    $jsonData['register_username'],
    $jsonData['register_password'],
    $jsonData['position'],
    $jsonData['register_age'],
    $jsonData['register_address'],
    $jsonData['mobile_number']
);

$employeeModel = new EmployeeModel();
$id = $employeeModel->registerEmployee($employee);

echo json_encode('user_added');
die();