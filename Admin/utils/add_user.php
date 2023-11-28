<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../../Objects/User.php';
require_once __DIR__ . '/../../Models/UserModel.php';
$jsonData = json_decode(file_get_contents("php://input"), true);
$user = (new User())->newUser(
    $jsonData['register_firstname'],
    $jsonData['register_lastname'],
    $jsonData['register_username'],
    $jsonData['register_password'],
    $jsonData['register_age'],
    $jsonData['register_address'],
    $jsonData['mobile_number']
);
$userModel = new UserModel();
$userModel->registerUser($user);
echo json_encode('user_added');
die();