<?php
include __DIR__ . "/../include/header.php";
include __DIR__ . "/../Model/Add_card.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $Contact = $_POST['Contact'];
    $Delivery = $_POST['Delivery'];
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $Address = $_POST["Address"];
    $Apartment = $_POST["Apartment"];
    $City = $_POST['City'];
    $Postal = $_POST['postal'];
    echo $Contact ;
    die;
    $user = new Add_card($First_name, $Last_name, $Address, $Contact, $Delivery, $Apartment, $City, $Postal);
    if ($user->register_Add_card()) {
        echo "<div class='alert alert-success' role='alert'>Card details added successfully!</div>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Error adding card details</div>";
    }
}
?>
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }
    .form-container {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-top: 80px;
        max-width: 700px;
    }

    .form-heading {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-heading h2 {
        font-size: 36px;
        font-weight: 700;
        color: #212529;
    }

    .btn-submit {
        background-color: #000;
        color: #fff;
        width: 100%;
        padding: 12px;
        font-size: 18px;
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #d4ff27;
        color: #000;
    }

    label {
        font-weight: 500;
    }
</style>
<br>
<div class="container d-flex justify-content-center align-items-center">
    <div class="form-container">
        <div class="form-heading">
            <h2>Proceed to Add Card</h2>
        </div>

        <form method="post">
            <h5 class="mb-3 fw-bold">Contact Information</h5>

            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="number" name="Contact" class="form-control" id="contact" placeholder="Enter your mobile number" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Delivery</label>
                <select class="form-select" name="Delivery" id="country" required>
                    <option value="">Select Country</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="UAE">UAE</option>
                    <option value="United Kingdom">United Kingdom</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" class="form-control" name="First_name" id="firstName" placeholder="Enter your first name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="text" class="form-control" name="Last_name" id="lastName" placeholder="Enter your last name" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="Address" rows="2" placeholder="Enter your address" required></textarea>
            </div>

            <div class="mb-3">
                <label for="apartment" class="form-label">Apartment, suite, etc. (optional)</label>
                <input type="text" class="form-control" id="apartment" name="Apartment" placeholder="Enter apartment info">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="City" id="city" placeholder="Enter your city" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="postal" class="form-label">Postal code (optional)</label>
                    <input type="text" class="form-control" name="postal" id="postal" placeholder="Enter postal code">
                </div>
            </div>

            <div class="mb-4">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="Phone" placeholder="Enter your phone number" required>
            </div>

            <button type="submit" class="btn-submit">Continue</button>
        </form>
    </div>
</div>

<br><br><br><br><br><br><br><br>
<?php
include __DIR__ . "/../include/footer.php";
?>
