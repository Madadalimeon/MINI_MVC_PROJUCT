<?php
session_start();
include __DIR__ . "/../Model/Add_card.php";
if (!isset($_SESSION['cart']) && isset($_COOKIE['cart_cookie'])) {
  $_SESSION['cart'] = json_decode($_COOKIE['cart_cookie'], true);
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
  header("Location: cart.php");
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
  header("Location: cart.php");
  exit;
}

if (isset($_POST['decrease'])) {
  $product_id = $_POST['product_id'];
  foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $product_id && $item['quantity'] > 1) {
      $item['quantity']--;
      break;
    }
  }
  setcookie("cart_cookie", json_encode($_SESSION['cart']), time() + (7 * 24 * 60 * 60), "/");
  header("Location: cart.php");
  exit;
}
if (isset($_POST['First_name']) == "POST") {
  unset($_SESSION["cart"]);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }

    .cart-container {
      margin-top: 60px;
    }

    .card {
      border-radius: 12px;
      border: none;
    }

    .form-container {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-submit {
      background-color: #000;
      color: #fff;
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 8px;
      transition: 0.3s;
    }

    .btn-submit:hover {
      background-color: #d4ff27;
      color: #000;
    }
  </style>
</head>

<body>
  <div class="container cart-container">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="fw-bold mb-3 text-center">Your Shopping Cart</h4>
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
              $cart = $_SESSION['cart'];
              foreach ($cart as $product) {
                $product_id = intval($product['id']);
                $product_quantity = $product['quantity'];
            ?>
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                  <div class="d-flex align-items-center">
                    <img src="../uploads/<?php echo $product['image']; ?>"
                      alt="<?php echo $product['name']; ?>"
                      class="rounded me-3" style="width:80px; height:80px; object-fit:cover;">
                    <div>
                      <h6 class="fw-bold mb-1"><?php echo $product['name']; ?></h6>
                      <p class="text-muted mb-1">Price: <strong>$<?php echo $product['price']; ?></strong></p>
                      <form method="post" class="d-flex align-items-center">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="decrease" class="btn btn-outline-secondary btn-sm me-2"><i class="fa fa-minus"></i></button>
                        <span class="fw-bold"><?php echo $product['quantity']; ?></span>
                        <button type="submit" name="increase" class="btn btn-outline-secondary btn-sm ms-2"><i class="fa fa-plus"></i></button>
                      </form>
                    </div>
                  </div>
                  <form method="post">
                    <input type="hidden" name="remove_id" value="<?php echo $product['id']; ?>">
                    <button class="btn btn-outline-danger btn-sm" type="submit" name="remove">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </div>
            <?php
              }
            } else {
              echo '<p class="text-center text-muted mb-0">Your cart is empty.</p>';
            }
            ?>
            <a href="../View/index.php" class="btn btn-outline-dark mt-3 w-100">
              <i class="fa fa-arrow-left"></i> Continue Shopping
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Order Summary</h5>
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
                <p><strong>$<?php echo number_format($subtotal, 2); ?></strong></p>
              </div>
              <div class="d-flex justify-content-between">
                <p>Shipping</p>
                <p><strong>$<?php echo number_format($shipping, 2); ?></strong></p>
              </div>
              <hr>
              <div class="d-flex justify-content-between">
                <h6>Total</h6>
                <h6 class="text-success"><strong>$<?php echo number_format($total, 2); ?></strong></h6>
              </div>
            <?php else: ?>
              <p class="text-muted">No items in your cart.</p>
            <?php endif; ?>
          </div>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $Contact = $_POST['Contact'];
          $Delivery = $_POST['Delivery'];
          $First_name = $_POST['First_name'];
          $Last_name = $_POST['Last_name'];
          $Address = $_POST["Address"];
          $Apartment = $_POST["Apartment"];
          $City = $_POST['City'];
          $Postal = $_POST['postal'];
          $user = new Add_card($First_name, $Last_name, $Address, $Contact, $Delivery, $Apartment, $City, $Postal);

          if ($user->Add_card_Proceed()) {
                echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Order Placed!',
            text: 'Order has been placed.',
          });
        </script>";
 
          } else {
            echo "<div class='alert alert-success' role='alert'>Error adding card details</div>";
          }
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
          $database = new Database();
          $db = $database->getDB();
          $Updata = "UPDATE Products SET Products_Stock = Products_Stock - ?   WHERE Products_id = ?;";
          $stmt = $db->prepare($Updata);
          $stmt->bind_param("ii", $product_quantity, $product_id);
          $stmt->execute();
        }
        ?>




        <div class="form-container">
          <h5 class="fw-bold text-center mb-3">Shipping from</h5>
          <form method="post">
            <div class="mb-3">
              <label class="form-label">Contact</label>
              <input type="number" name="Contact" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Delivery Country</label>
              <select class="form-select" name="Delivery" required>
                <option value="">Select</option>
                <option value="Pakistan">Pakistan</option>
                <option value="UAE">UAE</option>
                <option value="United Kingdom">United Kingdom</option>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="First_name" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="Last_name" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Address</label>
              <textarea class="form-control" name="Address" rows="2" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Apartment (optional)</label>
              <input type="text" class="form-control" name="Apartment">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" name="City" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Postal (optional)</label>
                <input type="text" class="form-control" name="postal">
              </div>
            </div>
            <div class="mb-4">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" name="Phone" required>
            </div>
            <button type="submit" class="btn-submit">Continue</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>