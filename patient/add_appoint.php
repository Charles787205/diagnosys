<?php
session_start();
require_once '../Objects/Patient.php';
require_once '../Objects/Appointment.php';
require_once '../Models/AppointmentModel.php';
require_once '../Objects/Services.php';
require_once '../Models/PatientModel.php';

if (true) {
    $appointment = new Appointment();
    $patient = new Patient();
    $appointmentModel = new AppointmentModel();
    $patient->first_name = $_POST['appointment_firstname'];
    $patient->last_name = $_POST['appointment_lastname'];
    $patient->gender = $_POST['appointment_gender'];
    $patient->birthdate = $_POST['appointment_birthdate'];
    $patient->age = $_POST['appointment_age'];
    $patient->province = $_POST['appointment_province'];
    $patient->city = $_POST['appointment_city'];
    $patient->barangay = $_POST['appointment_barangay'];
    $patient->purok = $_POST['appointment_purok'];
    $patient->mobile_number = $_POST['appointment_phone'];
    //$appointment->total=$_POST['appointment_amount'];
    $appointment->user_id = $_SESSION['id'];
    $appointment->appointment_date = $_POST['appointment_date'];
    $services_selected_arr = $_POST['appointment_test'];
    $services = array();
    //foreach($services_selected_arr as $serviceId){
    //$service = new Services();
    //$service->id = $serviceId;
    //$services[] = $service;
    //echo $serviceId;
    ///}
    //$appointment->services= $services;



    $target_dir = "../uploads/";
    echo $_FILES['fileToUpload']['name'];
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $targetDir = "../uploads/";
        $filename = str_replace(' ', '_', basename($_FILES["fileToUpload"]["name"]));
        // Generate a new file name (you can customize this logic)
        $newFileName = "user_id_" . time() . "_" . $filename;

        $targetFile = $targetDir . $newFileName;
        $patientModel = new PatientModel();
        $checkPatient = $patientModel->getPatientWithFirstNameAndLastName($patient->first_name, $patient->last_name); //returns Patient if exist and false if it doesn't exist

        //upload the image if the patient exist else no upload
        if (!$checkPatient) { //patient doesn't exist

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                echo "File has been uploaded successfully.";
                $patient->image_url = $newFileName;
                $appointment->patient = $patient;
                $appointmentModel->createAppointment($appointment);
                header('Location: patient-tables-data.php');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            $appointment->patient = $checkPatient;
            $appointmentModel->createAppointment($appointment);
            header('Location: patient-tables-data.php');
        }
    } else {
        echo "Error: " . $_FILES["fileToUpload"]["error"];
        header('Location: patient-appointment.php?error_message=Empty File');
    }
}
