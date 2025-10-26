<?php
include ("connection.php");
class RegisterUser {
    private $conn;
    private $db_table_name = "register";
    public $username;
    public $email;
    public $password;
    public function __construct($username, $email, $password) {
        $database = new Database();
        $this->conn = $database->getDB();
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
    public function register() {
        $query = "INSERT INTO " . $this->db_table_name . " (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $this->username, $this->email, $this->password);
        return $stmt->execute();
    }
}
?>
