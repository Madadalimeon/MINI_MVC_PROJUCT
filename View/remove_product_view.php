<?php
include '../Controller/ProductController.php';
$controller = new ProductController();
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($controller->deleteProduct($id)) {
        header("Location: remove_product_view.php?success=1");
        exit();
    } else {
        header("Location: remove_product_view.php?error=1");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_stock'])) {
    if ($controller->updateProductStock($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['new_stock'], $_POST['product_image'])) {
        header("Location: remove_product_view.php?updated=1");
        exit();
    } else {
        header("Location: remove_product_view.php?update_error=1");
        exit();
    }
}

$products = $controller->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Products</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">


<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">My Store</a>
    <div class="d-flex">
      <a href="index.php" class="btn btn-warning btn-sm">index</a>
    </div>
  </div>
</nav>



<div class="container py-5">
  <h2 class="text-center text-success mb-4">Manage & Remove Products</h2>
  <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success text-center">Product removed successfully!</div>
  <?php elseif(isset($_GET['error'])): ?>
    <div class="alert alert-danger text-center">Failed to remove product!</div>
  <?php elseif(isset($_GET['updated'])): ?>
    <div class="alert alert-success text-center">Stock updated successfully!</div>
  <?php elseif(isset($_GET['update_error'])): ?>
    <div class="alert alert-danger text-center">Failed to update stock!</div>
  <?php endif; ?>

  <table class="table table-bordered text-center align-middle bg-white shadow">
    <thead class="table-success">
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($products as $p): ?>
        <tr>
          <td><?= $p['Products_id'] ?></td>
          <td><img src="../uploads/<?= $p['Products_img'] ?>" width="70" height="70" style="object-fit:contain;"></td>
          <td><?= $p['Products_name'] ?></td>
          <td>Rs. <?= $p['Products_price'] ?></td>
          <td><?= $p['Products_Stock'] ?></td>
          <td>
            <form method="POST" style="display:inline-block;">
              <input type="hidden" name="product_id" value="<?= $p['Products_id'] ?>">
              <input type="hidden" name="product_name" value="<?= $p['Products_name'] ?>">
              <input type="hidden" name="product_price" value="<?= $p['Products_price'] ?>">
              <input type="hidden" name="product_image" value="<?= $p['Products_img'] ?>">
              <input type="number" name="new_stock" value="<?= $p['Products_Stock'] ?>" class="form-control form-control-sm mb-1" style="width:80px;display:inline-block;">
              <button type="submit" name="update_stock" class="btn btn-primary btn-sm">Update</button>
            </form>
            <a href="?delete=<?= $p['Products_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
