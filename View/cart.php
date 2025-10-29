<?php
session_start();
if (!isset($_SESSION['cart']) && isset($_COOKIE['cart_cookie'])) {
  $_SESSION['cart'] = json_decode($_COOKIE['cart_cookie'],true);
}
if (isset($_POST['remove'])) {
  $remove_id = $_POST['remove_id'];
  foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['id'] == $remove_id) {
      unset($_SESSION['cart'][$key]);
      break;
    }
  }
  setcookie("cart_cookie", json_encode($_SESSION['cart']), time() + (7 * 24 * 60 * 60), "/");
   echo '<script>window.location.href = window.location.href;</script>';
  exit;
}
if (isset($_POST['increase'])) {
  $product_id = $_POST['product_id'];
  foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $product_id) {
      $item['quantity']++;
      break;
    }  
}
  setcookie("cart_cookie", json_encode($_SESSION['cart']), time() + (7 * 24 * 60 * 60), "/");
  header("Location: ../View/cart.php");
  exit;
}

if (isset($_POST['decrease'])) {
  $product_id = $_POST['product_id'];
  foreach ($_SESSION['cart'] as &$item) {
    echo "<pre>";
    print_r($_SESSION['cart']);
    echo "</pre>";
    if ($item['id'] == $product_id && $item['quantity'] > 1) {
      $item['quantity']--;
      break;
    }
  }
  setcookie("cart_cookie", json_encode($_SESSION['cart']), time() + (7 * 24 * 60 * 60), "/");
  header("Location: ../View/cart.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
</head>
<body>
  <div class="container my-5">
    <div class="row">
      <div class="col-12 mb-4 text-center">
        <h2 class="fw-bold">Shopping Cart</h2>
        <p class="text-muted">Review your items before checkout</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <div class="card shadow-sm mb-3">
          <div class="card-body">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
              $cart = $_SESSION['cart'];
              setcookie("cart_cookie", json_encode($cart), time() + (7 * 24 * 60 * 60), "/");
              foreach ($cart as $product) {
            ?>
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                  <div class="d-flex align-items-center">
                    <img src="../uploads/<?php echo $product['image']; ?>"
                      alt="<?php echo $product['name']; ?>"
                      class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                    <div>
                      <h5 class="mb-1"><?php echo $product['name']; ?></h5>
                      <p class="text-muted mb-1">Price: <strong>$.<?php echo $product['price']; ?></strong></p>
                      <form method="post" class="d-flex align-items-center">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="decrease" class="btn btn-outline-secondary btn-sm me-2">
                          <i class="fa fa-minus"></i>
                        </button>
                        <span class="fw-bold"><?php echo $product['quantity']; ?></span>
                        <button type="submit" name="increase" class="btn btn-outline-secondary btn-sm ms-2">
                          <i class="fa fa-plus"></i>
                        </button>
                      </form>

                    </div>
                  </div>
                  <form method="post">
                    <input type="hidden" name="remove_id" value="<?php echo $product['id']; ?>">
                    <button class="btn btn-outline-danger btn-sm" type="submit" name="remove">
                      <i class="fa fa-trash"></i> Remove
                    </button>
                  </form>
                </div>
            <?php
              }
            } else {
              echo '<p class="text-center text-muted mb-0">Your cart is empty.</p>';
            }
            ?>
            <a href="../View/index.php" class="btn btn-outline-primary mt-3">
              <i class="fa fa-arrow-left"></i> Continue Shopping
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="mb-3">Order Summary</h5>
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
              $subtotal = 0;
              foreach ($_SESSION['cart'] as $item) {
                $subtotal += $item['price'] * $item['quantity'];
              }
              $shipping = 200;
              $total = $subtotal + $shipping;
            ?>
              <div class="d-flex justify-content-between">
                <p>Subtotal</p>
                <p><strong>Rs.<?php echo number_format($subtotal, 2); ?></strong></p>
              </div>
              <div class="d-flex justify-content-between">
                <p>Shipping</p>
                <p><strong>Rs.<?php echo number_format($shipping, 2); ?></strong></p>
              </div>
              <hr>
              <div class="d-flex justify-content-between mb-3">
                <h6>Total</h6>
                <h6 class="text-success"><strong>Rs.<?php echo number_format($total, 2); ?></strong></h6>
              </div>
              <a href="Proceed_add_card.php"><button class="btn btn-success w-100"><i class="fa fa-credit-card"></i> Proceed to Checkout</button></a>
            <?php else: ?>
              <p class="text-muted">Add an item to view order summary.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>