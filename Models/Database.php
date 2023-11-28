<?php
 class Database {

  protected $connection = null;
  private $db_host = 'localhost';
  private $db_username = 'root';
  private $db_password = '';
  private $db_name = 'diagnostic_db';
  
  public function __construct(){
    
    try {
    
      $this -> connection = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);

      if (mysqli_connect_errno()){
        throw new Exception("Could not connect to database.");
      } 
      }catch (Exception $e){
        throw new Exception($e -> getMessage());
      }
  }

  public function checkConnection(){
    
    
  }

  public function close(){
    try{

      $this->connection->close();
    }catch(Error $e){

    }
    
  }
   
}