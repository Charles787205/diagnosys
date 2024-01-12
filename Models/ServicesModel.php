<?php
require_once 'Database.php';
require_once __DIR__ . '/../Objects/Services.php';
class ServicesModel extends Database
{

    public function getAllServices()
    {
        $this->checkConnection();
        $sql = 'SELECT * FROM services';
        $result = $this->connection->query($sql);
        $services = array();
        while ($row = $result->fetch_assoc()) {
            $service = new Services();
            $service->id = $row['id'];
            $service->name = $row['name'];
            $service->price = $row['price'];
            $service->normal_value = $row['normal_value'];
            $services[] = $service;
        }
        $this->close();
        return $services;
    }
    public function getServicesByRequestId($id)
    {
        $this->checkConnection();
        $sql = 'SELECT
                services.id AS service_id,
                services.name AS service_name,
                services.price,
                services.normal_value,
                request_services.test,
                request_services.result
                
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
            $this->close();
            $services = array();
            foreach ($data as $d) {
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


            return false;
        }
    }
    public function getServicesByAppointmentId($id)
    {
        $this->checkConnection();
        $sql = 'SELECT
                services.id AS service_id,
                services.name AS service_name,
                services.price,
                services.normal_value
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

            $services = array();
            foreach ($data as $d) {
                $service = new Services();
                $service->name = $d['service_name'];
                $service->id = $d['service_id'];
                $service->price = $d['price'];
                $service->normal_value = $d['normal_value'];
                $services[] = $service;
            }

            return $services;
        } else {
            // Handle the case where the query execution fails
            return false;
        }
    }
    function getServiceSales()
    {
        $this->checkConnection();
        $sql = "SELECT s.name AS name, SUM(s.price) AS price FROM `request_services` rs JOIN `services` s ON rs.service_id = s.id GROUP BY s.name;";
        $statement = $this->connection->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->get_result();

            // Fetch all rows as objects
            $data = [];
            while ($row = $result->fetch_object('Services')) {
                $data[] = $row;
            }
            $this->close();
            return $data;
        }
    }
    function getServicesByName($serviceName)
    {
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
    function getServicesByDateAndName()
    {
        $this->checkConnection();
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



    function addService($service)
    {
        $sql = "INSERT INTO `services` (`name`, `price`, `normal_value`) VALUES (?, ?, ?)";
        $statement = $this->connection->prepare($sql);

        // Bind the parameters
        $statement->bind_param("sds", $service->name, $service->price, $service->normal_value);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function editServicesById(Services $service)
    {
        $sql = "UPDATE `services` SET `name` = ?, `normal_value` = ?, `price` = ? WHERE `id` = ?";
        $statement = $this->connection->prepare($sql);

        // Bind the parameters
        $statement->bind_param("ssii", $service->name, $service->normal_value, $service->price, $service->id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function deleteServiceById($id)
    {
        $sql = "DELETE FROM `services` WHERE `id` = ?";
        $statement = $this->connection->prepare($sql);

        // Bind the parameter
        $statement->bind_param("i", $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
