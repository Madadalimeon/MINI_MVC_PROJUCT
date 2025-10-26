<?php
include 'connection.php';
class LoginUser {
    private $conn;
    private $db_table_name = "register";
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getDB();
    }
    public function login($username, $password) {
        $query = "SELECT username, password FROM " . $this->db_table_name . " WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($password === $user['password']) { 
                return $user;
            }
        }
        return false;
    }
}
?>
