<?php
include("connection.php");

class Product {
    private $conn;
    private $table = "products";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getDB();
    }

    public function addProduct($name, $price, $stock, $image) {
        $query = "INSERT INTO " . $this->table . " (Products_name, Products_img, Products_price, Products_Stock) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdi", $name, $image, $price, $stock);
        return $stmt->execute();
    }

    public function updateProduct($id, $name, $price, $stock, $image) {
        $query = "UPDATE " . $this->table . " SET Products_name=?, Products_img=?, Products_price=?, Products_Stock=? WHERE Products_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdii", $name, $image, $price, $stock, $id);
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
