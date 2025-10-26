<?php
include '../Controller/RegisterController.php';
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Register Form</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f0f0f0;
}
.container {
    width: 400px;
    padding: 30px;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 8px;
}
.container h2 { text-align: center; margin-bottom: 20px; color: #333; }
.container_form { display: flex; flex-direction: column; }
.container_a { font-size: 14px; text-align: center; margin: 10px 0; }
</style>
</head>
<body>
<div class="container">
    <h2>Register Form</h2>
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger">Registration Failed! Try again.</div>
    <?php endif; ?>
    <div class="container_form">
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="container_a">
                <a href="login.php" style="text-decoration:none;">Login here</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
