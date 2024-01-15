<?php
header("Access-Control-Allow-Origin: *");
session_start();

require_once __DIR__ . '/../../Objects/Patient.php';

require_once __DIR__ . '/../../Models/RequestModel.php';
require_once __DIR__ . '/../../Objects/Services.php';
require_once __DIR__ . '/../../Models/PatientModel.php';



$patient = new Patient();

$patient->first_name = $_POST['request_firstname'];
$patient->last_name = $_POST['request_lastname'];
$patient->gender = $_POST['request_gender'];
$patient->birthdate = $_POST['request_birthdate'];
$patient->age = $_POST['request_age'];
$patient->province = $_POST['request_province'];
$patient->city = $_POST['request_city'];
$patient->barangay = $_POST['request_barangay'];
$patient->purok = $_POST['request_purok'];
$patient->mobile_number = $_POST['request_phone'];
$patient->id = $_POST['patient_id'];
$patientModel = new PatientModel();
$patientModel->editPatient($patient);