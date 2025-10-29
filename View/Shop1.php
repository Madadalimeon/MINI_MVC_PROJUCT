<?php
include __DIR__ ."/../Model/connection.php";
include __DIR__ ."/../include/header.php";
?>
<br><br><br><br><br>

<div class="container">
    <div class="row">
        <div class="col">
            <center><h2 class="mb-4">Shop for you live people</h2></center>
            <div class="row row-cols-1 row-cols-md-3 g-4">
              <?php
              $database = new Database();
              $db = $database->getDB();
              $select_query = "SELECT * FROM products";
              $stmt = $db->prepare($select_query);
              $stmt->execute();
              $result = $stmt->get_result();
              while ($row = $result->fetch_assoc()) {
              ?>
              <div class="col">
            <div class="card h-100">
              <img src="images/<?php echo $row['Products_img']; ?>" class="card-img-top" alt="<?php echo $row['Products_name']; ?>" style="height: 300px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['Products_name']; ?></h5>
                <p class="card-text text-primary fw-bold">$<?php echo $row['Products_price']; ?></p>
                <a href="Shop.php?add_to_cart=<?php echo $row['Products_id']; ?>" class="btn btn-dark w-100">
                  Add to Cart <i class="bi bi-cart-plus"></i>
                </a>
              </div>
            </div>
              </div>
              <?php
              }
              ?>
            </div>
        </div>
    </div>
</div>

<br><br><br><br><br>
<?php
include __DIR__ ."/../include/footer.php";
?>