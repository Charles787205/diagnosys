<?php
include 'connection/conn.php';

if (isset($_POST['submit'])) {
  $total_amount= $_POST['total_amount'];

  $sql = "INSERT INTO `billing` (total_amount) VALUES ('$total_amount')";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    //echo "Data inserted successfully";
   header('Location: cashier-payment-list.php');
     //echo '<script>alert("Data Inserted Successfully")</script>';
  } else {
    die(mysqli_error($conn));
  }
}

?>
