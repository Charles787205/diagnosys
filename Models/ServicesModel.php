<?php 
require_once 'Database.php';
require_once __DIR__ . '/../Objects/Services.php';
class ServicesModel extends Database{

  public function getAllServices(){
    $sql = 'SELECT * FROM services';
    $result = $this->connection->execute_query($sql);
    $services = array();
    while($row = $result->fetch_assoc()){
      $service = new Services();
      $service->id = $row['id'];
      $service->name = $row['name'];
      $service->price = $row['price'];
      $services[] = $service;
      
    }
    $this->connection->close();
    return $services;
  }
  public function getServicesByRequestId($id) {
    $sql = 'SELECT
                services.id AS service_id,
                services.name AS service_name,
                services.price,
                request_services.test,
                request_services.result,
                request_services.normal_value
            FROM
                request_services
            JOIN
                services ON services.id = request_services.service_id
            WHERE
                request_services.request_id =  ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();
        $services = array();
        foreach($data as $d){
          $service = new Services();
          $service->name = $d['service_name'];
          $service->id = $d['service_id'];
          $service->price = $d['price'];
          $service->result = $d['result'];
          $service->test = $d['test'];
          $service->normal_value = $d['normal_value'];
          $services[] = $service;
        }
        
        return $services;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  public function getServicesByAppointmentId($id) {
    $sql = 'SELECT
                services.id AS service_id,
                services.name AS service_name,
                services.price
            FROM
                services
            JOIN
                appointment_services ON services.id = appointment_services.service_id
            WHERE
                appointment_services.appointment_id = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();
        $services = array();
        foreach($data as $d){
          $service = new Services();
          $service->name = $d['service_name'];
          $service->id = $d['service_id'];
          $service->price = $d['price'];
          $services[] = $service;
        }
       
        return $services;
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  function getServiceSales() {
    $sql = "SELECT s.name AS name, SUM(s.price) AS price FROM `request_services` rs JOIN `services` s ON rs.service_id = s.id GROUP BY s.name;";
    $statement = $this->connection->prepare($sql);

    if ($statement->execute()) {
        $result = $statement->get_result();

        // Fetch all rows as objects
        $data = [];
        while ($row = $result->fetch_object('Services')) {
            $data[] = $row;
        }
        
        return $data;
    }
}
  function close(){
    $this->connection->close();
  }
  function getServicesByName($serviceName) {
    $sql = "SELECT * FROM `services` WHERE `name` = ?";
    $statement = $this->connection->prepare($sql);

    // Bind the parameter
    $statement->bind_param("s", $serviceName);

    if ($statement->execute()) {
        $result = $statement->get_result();

        // Fetch all rows as objects
        $data = $result->fetch_object('Services');
        
        return $data;
    }
  }
    function getServicesByDateAndName() {
        $sql = "SELECT
                    r.request_date AS date,
                    s.name AS name,
                    s.price AS price,
                    COUNT(*) AS service_count
                FROM
                    `request_services` rs
                JOIN
                    `request` r ON rs.request_id = r.id
                JOIN
                    `services` s ON rs.service_id = s.id
                GROUP BY
                    r.request_date, s.name
                ORDER BY
                    r.request_date DESC;";
        
        $statement = $this->connection->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->get_result();

            // Fetch all rows as objects
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            return $data;
        }

    }

    



}