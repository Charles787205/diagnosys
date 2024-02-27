<?php
session_start();
require_once __DIR__ . '/../../Objects/Patient.php';
require_once __DIR__ . '/../../Objects/Appointment.php';
require_once __DIR__ . '/../../Models/AppointmentModel.php';
require_once __DIR__ . '/../../Objects/Services.php';
require_once __DIR__ . '/../../Models/PatientModel.php';




if (true) {
    $appointment = new Appointment();
    $patient = new Patient();
    $appointmentModel = new AppointmentModel();
    $patient->first_name = $_POST['appointment_firstname'];
    $patient->middle_name = $_POST['appointment_middlename'];
    $patient->last_name = $_POST['appointment_lastname'];
    $patient->suffix = $_POST['appointment_suffix'];
    $patient->gender = $_POST['appointment_gender'];
    $patient->birthdate = $_POST['appointment_birthdate'];
    $patient->age = $_POST['appointment_age'];
    $patient->province = $_POST['appointment_province'];
    $patient->city = $_POST['appointment_city'];
    $patient->barangay = $_POST['appointment_barangay'];
    $patient->purok = $_POST['appointment_purok'];
    $patient->subdivision = $_POST['appointment_subdivision'];
    $patient->house_no = $_POST['appointment_house_no'];
    $patient->mobile_number = $_POST['appointment_phone'];
    $patient->id_type = $_POST['id_type'];
    $appointment->total = 0;
    $appointment->user_id = $_POST['user_id'];
    $appointment->appointment_date = $_POST['appointment_date'];
    //$services_selected_arr = $_POST['appointment_test'];
    $services = array();
    //foreach ($services_selected_arr as $serviceId) {
    //    $service = new Services();
    //    $service->id = $serviceId;
    //    $services[] = $service;
    //    echo $serviceId;
    //}
    $appointment->services = $services;



    $target_dir = "../uploads/";
    echo $_FILES['fileToUpload']['name'];
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $targetDir = "../../uploads/";
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
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            $appointment->patient = $checkPatient;
            $appointmentModel->createAppointment($appointment);
        }
    } else {
        echo json_encode(array("message" => "Error: " . $_FILES["fileToUpload"]["error"]));
        //header('Location: patient-appointment.php?error_message=Empty File');
    }
}
