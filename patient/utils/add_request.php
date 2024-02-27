<?php
header("Access-Control-Allow-Origin: *");
session_start();

require_once __DIR__ . '/../../Objects/Patient.php';
require_once __DIR__ . '/../../Objects/Request.php';
require_once __DIR__ . '/../../Models/RequestModel.php';
require_once __DIR__ . '/../../Objects/Services.php';
require_once __DIR__ . '/../../Models/PatientModel.php';


$request = new Request();
$patient = new Patient();
$requestModel = new RequestModel();
$patient->first_name = $_POST['request_firstname'];
$patient->middle_name = $_POST['request_middlename'];
$patient->last_name = $_POST['request_lastname'];
$patient->gender = $_POST['request_gender'];
$patient->birthdate = $_POST['request_birthdate'];
$patient->age = $_POST['request_age'];
$patient->province = $_POST['request_province'];
$patient->city = $_POST['request_city'];
$patient->barangay = $_POST['request_barangay'];
$patient->purok = $_POST['request_purok'];
$patient->suffix = $_POST['request_suffix'];
$patient->subdivision = $_POST['request_subdivision'];
$patient->house_no = $_POST['request_house_no'];
$patient->mobile_number = $_POST['request_phone'];
$patient->id_type = $_POST['request_id_type'];
$request->total = 0;
$request->user_id = $_POST['user_id'];

$services = array();

$request->services = $services;



$target_dir = "../uploads/";
$newFileName = '';
$patientModel = new PatientModel();
$checkPatient = $patientModel->getPatientWithFirstNameAndLastName($patient->first_name, $patient->last_name);
if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
    $targetDir = __DIR__ . "/../../uploads/";

    $filename = str_replace(' ', '_', basename($_FILES["fileToUpload"]["name"]));
    // Generate a new file name (you can customize this logic)
    $newFileName = "user_id_" . time() . "_" . $filename;
    $targetFile = $targetDir . $newFileName;

    //returns Patient if exist and false if it doesn't exist

    echo ($fileuploaded = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile));
    if (!$checkPatient) { //patient doesn't exist



        $patient->image_url = $newFileName;
        $request->patient = $patient;

        $requestModel->createRequest($request);
    } else {

        $request->patient = $checkPatient;
        $requestModel->createRequest($request);
    }
}

echo json_encode('Success');
