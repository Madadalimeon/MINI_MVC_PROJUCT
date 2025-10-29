<?php
include("connection.php");
class Product {
    private $conn;
    private $table = "products";
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getDB();
    }
    public function addProduct($name, $price, $stock, $image,$Products_add_time) {
        $query = "INSERT INTO " . $this->table . " (Products_name, Products_img, Products_price, Products_Stock,Products_add_time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdis", $name, $image, $price, $stock,$Products_add_time);
        return $stmt->execute();
    }
    public function updateProduct($id, $name, $price, $stock, $image,$Products_add_time) {
        $query = "UPDATE " . $this->table . " SET Products_name=?, Products_img=?, Products_price=?, Products_Stock=?, Products_add_time=? WHERE Products_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdiis", $name, $image, $price, $stock, $Products_add_time, $id);
        return $stmt->execute();
    }
    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->table . " WHERE Products_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>