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
        $sql = "INSERT INTO users_table (username, password) VALUES (?,?)";
        $stmt = $this->connection->prepare($sql);
    }
}
?>