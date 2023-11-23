<?php
  require_once '../Objects/Employee.php';
  require_once 'UserModel.php';
  

  class EmployeeModel extends UserModel{

    public function registerEmployee(Employee $employee){
      
      $id = $this->registerUser($employee);
      $sql = 'INSERT INTO employee VALUES (?,?);';
      $stmt = $this->connection->prepare($sql);
      $stmt->bind_param('is', $id, $employee->position);
      $stmt->execute();
      return $id;
    }
     public function getEmployeeById($employeeId) {
        $sql = 'SELECT user.*, employee.position FROM user JOIN employee ON user.id = employee.user_id WHERE user.id = ?';
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('i', $employeeId);
            $stmt->execute();

            $result = $stmt->get_result();
            $employee = $result->fetch_object('Employee');
            $this->connection->close();
            return $employee;
        } catch (Exception $error) {
            return null;
        }
    }

    public function getEmployeeIdByFirstNameAndPassword($username, $password) {
    $sql = 'SELECT user.id
            FROM user
            JOIN employee ON user.id = employee.user_id
            WHERE user.username = ? AND user.password = ?';

    $statement = $this->connection->prepare($sql);
    $statement->bind_param('ss', $username, $password);

    if ($statement->execute()) {
        $result = $statement->get_result();

        // Check if there is a matching record
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['id'];
            $statement->close();

            return $userId;
        }
    }

    // Return null or any value that indicates no match
    return null;
}

  }