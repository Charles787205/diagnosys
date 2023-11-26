<?php
session_start();
require_once __DIR__ . '/../../Objects/Patient.php';
require_once __DIR__ . '/../../Objects/Request.php';
require_once __DIR__ . '/../../Models/RequestModel.php';
require_once __DIR__ . '/../../Objects/Services.php';
require_once __DIR__ . '/../../Models/PatientModel.php';

if(true){
    $request = new Request();
    $patient = new Patient();
    $requestModel = new RequestModel();
    $patient->first_name=$_POST['request_firstname'];
    $patient->last_name=$_POST['request_lastname'];
    $patient->gender=$_POST['request_gender'];
    $patient->birthdate=$_POST['request_birthdate'];
    $patient->age=$_POST['request_age'];
    $patient->province = $_POST['request_province'];
    $patient->city = $_POST['request_city'];
    $patient->barangay=$_POST['request_barangay'];
    $patient->purok=$_POST['request_purok'];
    $patient->mobile_number=$_POST['request_phone'];
    $request->total=$_POST['request_amount'];
    $request->user_id = $_SESSION['id'];
    $services_selected_arr=$_POST['request_test'];
    $services = array();
    foreach($services_selected_arr as $serviceId){
        $service = new Services();
        $service->id = $serviceId;
        $services[] = $service;
        echo $serviceId;
    }
    $request->services= $services;
    
    
    
    $target_dir = "../uploads/";
    $newFileName = '';
    $patientModel = new PatientModel();
    $checkPatient = $patientModel->getPatientWithFirstNameAndLastName($patient->first_name, $patient->last_name);
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $targetDir = "../uploads/";
        
        $filename = str_replace(' ', '_',basename($_FILES["fileToUpload"]["name"]));
        // Generate a new file name (you can customize this logic)
        $newFileName = "user_id_" . time() . "_" . $filename;
        $targetFile = $targetDir . $newFileName;
        
         //returns Patient if exist and false if it doesn't exist
        
        $fileuploaded = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile);
        
    } 
    if(!$checkPatient){ //patient doesn't exist

        
      echo "File has been uploaded successfully.";
      $patient->image_url = $newFileName;
      $request->patient=$patient;
      
      $requestModel->createRequest($request);
      header('Location: pending-forms-elements.php');
      echo '<script>alert("Data Submitted Successfully")</script>';


    }else{
        
        $request->patient = $checkPatient; 
        $requestModel->createRequest($request);
        header('Location: pending-forms-elements.php');
    }
    
   
}
echo 'hello';
?>

