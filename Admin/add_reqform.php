<?php
include 'connection/conn.php';

if(isset($_POST['submit'])){
    $request_lastname = $_POST['request_lastname'];
    $request_firstname = $_POST['request_firstname'];
    $request_birthdate = $_POST['request_birthdate'];
    $request_age = $_POST['request_age'];
    $request_gender = $_POST['request_gender'];
    $request_province = $_POST['request_province'];
    $request_city = $_POST['request_city'];
    $request_barangay = $_POST['request_barangay'];
    $request_purok = $_POST['request_purok'];
    $request_phone = $_POST['request_phone'];
    $request_amount = $_POST['request_amount'];
    $request_test = $_POST['request_test'];
    $request_test1= implode('', $request_test);
    

    $sql="INSERT INTO `request_form`(request_lastname, request_firstname,request_gender, request_birthdate, request_age, 
    request_province, request_city, request_barangay, request_purok, request_phone, 
     request_test, request_amount)
    values('$request_lastname', ' $request_firstname', ' $request_gender', ' $request_birthdate', '$request_age', ' $request_province',
   '$request_city', '$request_barangay', '$request_purok', 
   '$request_phone', '$request_test1', '$request_amount')";

if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $request_lastname, $request_firstname, $request_gender, $request_birthdate, $request_age, 
        $request_province, $request_city, $request_barangay, $request_purok, $request_phone, $request_test1, $request_amount);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: pendinga-forms-elements.php');
        exit; // Make sure to exit after the header redirect
    } else {
        die(mysqli_error($conn));
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
}

?>