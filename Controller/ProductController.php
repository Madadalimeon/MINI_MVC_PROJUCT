<?php
include '../Model/Product.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function addProduct($name, $price, $stock, $imageFile) {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($imageFile['name']);
        move_uploaded_file($imageFile["tmp_name"], $targetFile);

        $imageName = basename($imageFile['name']);
        return $this->productModel->addProduct($name, $price, $stock, $imageName);
    }

    public function deleteProduct($id) {
        return $this->productModel->deleteProduct($id);
    }

    public function updateProductStock($id, $name, $price, $stock, $image) {
        return $this->productModel->updateProduct($id, $name, $price, $stock, $image);
    }

    public function getProducts() {
        return $this->productModel->getAllProducts();
    }
}
?>
