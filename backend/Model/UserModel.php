<?php
require "Model/Database.php";
class UserModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users_table ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }

    public function createUser($userData)
    {
        $sql = "INSERT INTO users_table (username, password) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        
        if (!$stmt) {
            // Handle the case where the statement preparation failed
            throw new Exception("Statement preparation failed");
        }
        
        $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
        $stmt->bind_param('ss', $userData['username'], $hashedPassword);

        if ($stmt->execute()) {
            // User was successfully created
            $stmt->close();
        } else {
            // Handle the case where the user creation failed
            $stmt->close();
            throw new Exception("User creation failed");
        }
    }
}
?>
