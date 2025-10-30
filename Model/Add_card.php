<?php
include "../Model/connection.php";
class Add_card{
    private $conn;
    private $Contact;
    private $Delivery;
    private $First_name;
    private $Last_name;
    private $Address;
    private $Apartment;
    private $City;
    private $Postal;
    function __construct($Contact, $Delivery, $First_name, $Last_name, $Address, $Apartment, $City, $Postal){
        $database = new Database();
        $this->conn = $database->getDB();
        $this->Contact = $Contact;
        $this->Delivery = $Delivery;
        $this->First_name = $First_name;
        $this->Last_name = $Last_name;
        $this->Address = $Address;
        $this->Apartment = $Apartment;
        $this->City = $City;
        $this->Postal = $Postal;
}
    function Add_card_Proceed(){
        $query = "INSERT INTO add_card (First_name, Last_name, Address, Contact, Delivery, Apartment, City, Postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssssi", $this->First_name, $this->Last_name, $this->Address, $this->Contact, $this->Delivery, $this->Apartment, $this->City, $this->Postal);
        return $stmt->execute();
    }
}
