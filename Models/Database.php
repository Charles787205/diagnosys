<?php
 class Database {

  protected $connection = null;
  public function __construct(){
    
    try {
      $db_host = 'localhost';
      $db_username = 'root';
      $db_password = null;
      $db_name = 'diagnostic_db';


      $this -> connection = new mysqli($db_host, $db_username, $db_password, $db_name);

      if (mysqli_connect_errno()){
        throw new Exception("Could not connect to database.");
      } 
      }catch (Exception $e){
        throw new Exception($e -> getMessage());
      }
  }
   
}