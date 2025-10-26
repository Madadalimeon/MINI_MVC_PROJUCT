<?php
include '../Controller/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProductController();
    if ($controller->addProduct($_POST['product_name'], $_POST['product_price'], $_POST['Stock'], $_FILES['product_image'])) {
        header("Location: add_product_view.php?success=1");
        exit();
    } else {
        header("Location: add_product_view.php?error=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">My Store</a>
    <div class="d-flex">
            <a href="index.php"class="btn btn-warning btn-sm me-2">index</a>
      <a href="remove_product_view.php" class="btn btn-warning btn-sm">Manage Products</a>
    </div>
  </div>
</nav>


<div class="container mt-5">
  <div class="card shadow p-4">
    <h3 class="text-center text-success mb-4">Add New Product</h3>
    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">Product added successfully!</div>
    <?php elseif(isset($_GET['error'])): ?>
      <div class="alert alert-danger">Failed to add product!</div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="product_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" name="product_price" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="Stock" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Product Image</label>
        <input type="file" name="product_image" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Add Product</button>
    </form>
  </div>
</div>
</body>
</html>
