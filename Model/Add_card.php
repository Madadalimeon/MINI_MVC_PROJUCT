<?php
include 'connection.php';

class Add_card {
    private $conn;
    private $db_table_name = "add_card";
    private $first_name;
    private $last_name;
    private $Address;
    private $Contact;
    private $Delivery;
    private $Apartment;
    private $City;
    private $Postal_code;

    public function __construct($first_name, $last_name, $Address, $Contact, $Delivery, $Apartment, $City, $Postal_code) {
        $database = new Database();
        $this->conn = $database->getDB();

        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->Address = $Address;
        $this->Contact = $Contact;
        $this->Delivery = $Delivery;
        $this->Apartment = $Apartment;
        $this->City = $City;
        $this->Postal_code = $Postal_code;
    }

    public function register_Add_card() {
        $query = "INSERT INTO " . $this->db_table_name . " (First_name, Last_name, Address, Contact, Delivery, Apartment, City, Postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssss", $this->first_name, $this->last_name, $this->Address, $this->Contact, $this->Delivery, $this->Apartment, $this->City, $this->Postal_code);
        return $stmt->execute();
    }
}
?>
