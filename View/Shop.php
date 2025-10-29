<?php
session_start();  
include("../include/header.php");
include('../Model/connection.php');
?>
<br><br><br><br><br><br><br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  body {
    background-color: #fff;
    font-family: 'Poppins', sans-serif;
  }
  .product-section {
    padding: 60px 5%;
  }
  .product-image img {
    width: 100%;
    height: 500px;
    object-fit: contain;
    border-radius: 10px;
    background-color: #f8f8f8;
  }
  .product-title {
    font-weight: 600;
    font-size: 28px;
    margin-bottom: 10px;
  }
  .price {
    font-size: 22px;
    font-weight: 600;
    color: #e74c3c;
  }
  .buy-btn {
    background-color: #111;
    color: #fff;
    border: none;
    width: 100%;
    padding: 14px;
    font-weight: 600;
    border-radius: 0;
    margin-top: 15px;
    transition: all 0.3s ease;
  }
  .buy-btn:hover {
    background-color: #333;
  }
</style>

<section class="product-section">
  <div class="row align-items-center">
    <?php
    $database = new Database();
    $db = $database->getDB();
    if (isset($_GET['add_to_cart'])) {
      $product_id = $_GET['add_to_cart']; 

      $select_query = "SELECT * FROM products WHERE Products_id = ?";
      $stmt = $db->prepare($select_query);
      $stmt->bind_param("i", $product_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {
    ?>
        <div class="col-lg-6 position-relative mb-5">
          <div class="product-image">
            <img src="../uploads/<?php echo $row['Products_img']; ?>" 
                 alt="<?php echo $row['Products_name']; ?>">
          </div>
        </div>

        <div class="col-lg-6 mt-4 mt-lg-0 mb-5">
          <h4 class="product-title"><?php echo $row['Products_name']; ?></h4>
          <p><strong>SKU:</strong> <?php echo $row['Products_id']; ?></p>
          <p><strong>Availability:</strong>
            <?php echo $row['Products_Stock'] > 0 ? "In stock" : "Out of stock"; ?>
          </p>
          <h5 class="mt-3">
            <span class="price">$<?php echo number_format($row['Products_price'], 2); ?></span>
          </h5>
          
          <form method="post">
            <input type="hidden" name="product_id" value="<?php echo $row['Products_id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $row['Products_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $row['Products_price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $row['Products_img']; ?>">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" name="buy_now" class="buy-btn">BUY NOW</button>
          </form>
        </div>
    <?php
      } else {
        echo "<p>Product not found.</p>"; 
      }
    } else {
      echo "<p>No product selected.</p>";
    }
    ?>
  </div>
</section>

<?php
if (isset($_POST['buy_now'])) {
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $quantity = $_POST['quantity'];

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  $found = false; 
  foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $product_id) {
      $item['quantity'] += $quantity;
      $found = true;
      break;
    }
  }

  if (!$found) {
    $_SESSION['cart'][] = [
      'id' => $product_id,
      'name' => $product_name,
      'price' => $product_price,
      'image' => $product_image,
      'quantity' => $quantity
    ];
  }

  setcookie("cart_cookie", json_encode($_SESSION['cart']), time() + (7 * 24 * 60 * 60), "/");

  echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Added to Cart!',
            text: 'Product added successfully.',
            confirmButtonColor: '#000000ff'
          }).then(() => {
            window.location.href = 'cart.php';
          });
        </script>";
}
?>

<br><br><br><br><br><br><br><br><br><br><br>
<?php include("../include/footer.php"); ?>
