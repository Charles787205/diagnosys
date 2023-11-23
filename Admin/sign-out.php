<?php 
  session_start();
  $_SESSION = array();
  header('Location: admin_login.php');
?>