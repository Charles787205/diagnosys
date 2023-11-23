<?php 
require_once '../Objects/User.php';
require_once 'Database.php';
class UserModel extends Database{

  public function registerUser(User $user){
    $sql = 'INSERT INTO user (first_name, last_name, username, password,age,address,mobile_number) VALUES (?, ?, ?,?,?,?,?)';
    try{
      
      $stmt = $this->connection->prepare($sql);
      $stmt->bind_param('sssssss', $user->first_name, $user->last_name, $user->username, $user->password,$user->age, $user->address, $user->mobile_number);
      $stmt->execute();
      return $this->connection->insert_id;
    }catch(error){
      return false;
    }
  }

  public function getUserById($userId) {
    $sql = 'SELECT * FROM user WHERE id = ?';
    try {
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_object('User');

        return $user;
    } catch (Exception $error) {
        return null;
    }
}
  public function getIdByUsernameAndPassword($username, $password){
    $sql = 'SELECT * FROM user WHERE username = ? AND password = ?';
    try {
        // Assuming passwords are securely hashed before storing in the database
        

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // Return the id if a matching user is found
            return $row['id'];
        } else {
            // Return null or some indication of not found
            return null;
        }
    } catch (Exception $error) {
        return 'error';
    }
  }
  public function updateUser(User $user) {
    $sql = 'UPDATE user
            SET
                first_name = ?,
                last_name = ?,
                username = ?,
                password = ?,
                age = ?,
                address = ?,
                mobile_number = ?
            WHERE
                id = ?';

    $statement = $this->connection->prepare($sql);
    
    // Assuming id is a property of the User class
    $statement->bind_param(
        'ssssisss',
        $user->first_name,
        $user->last_name,
        $user->username,
        $user->password,
        $user->age,
        $user->address,
        $user->mobile_number,
        $user->id
    );

    if ($statement->execute()) {
        $statement->close();
        return true;  // Return true on successful update
    } else {
        // Handle the case where the query execution fails
        return false;
    }
  }
  public function getUsers() {
    $sql = 'SELECT * FROM user';
    
    try {
        $result = $this->connection->query($sql);

        // Check if the query was successful
        if ($result) {
            // Fetch all rows as objects of the User class
            $users = [];
            while ($row = $result->fetch_object('User')) {
                $users[] = $row;
            }

            // Free the result set
            $result->free_result();

            return $users;
        } else {
            // Handle the case where the query fails
            return null;
        }
    } catch (Exception $error) {
        // Handle any exceptions that may occur
        return null;
    }
  }
  public function deleteUserById($userId) {
        $sql = 'DELETE FROM user WHERE id = ?';

        $statement = $this->connection->prepare($sql);
        $statement->bind_param('i', $userId);

        if ($statement->execute()) {
            echo "User with ID $userId deleted successfully";
        } else {
            echo "Error deleting user";
        }

        $statement->close();
  }

 



}