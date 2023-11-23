<?php
include 'connection/conn.php';

if(isset($_POST['submit'])){
  $register_lastname=$_POST['register_lastname'];
  $register_firstname=$_POST['register_firstname'];
  $register_username=$_POST['register_username'];
  $register_password=$_POST['register_password'];
  $user_type=$_POST['user_type'];


  $sql="INSERT INTO `register_user` (register_lastname, register_firstname, register_username, register_password, user_type)
  values('$register_lastname', '$register_firstname', '$register_username', '$register_password', '$user_type')";
  
  $result=mysqli_query($conn,$sql);
  if($result){
      //echo "Data inserted successfully";
    header('Location: registered.php');
    echo '<script>alert("Data Inserted Successfully")</script>';
  }else{
      die(mysqli_error($conn));
  }
}
?>