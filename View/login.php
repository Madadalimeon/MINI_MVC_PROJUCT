<?php
session_start();
include '../Model/LoginUser.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userModel = new LoginUser();
    $user = $userModel->login($username, $password);
    if ($user) {
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Login Form</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body {
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f0f0f0;
}
.container {
    width:400px;
    padding:30px;
    background:#fff;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    border-radius:8px;
}
.container h2 { text-align:center; margin-bottom:20px; color:#333; }
.container_a { font-size:14px; text-align:center; margin:10px 0; }
</style>
</head>
<body>
<div class="container">
    <h2>Login Form</h2>
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger">Invalid Username or Password!</div>
    <?php endif; ?>
    <form method="post" >
        <div class="mb-3">
            <label class="form-label">Username (Email)</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="container_a">
            <a href="register.php" style="text-decoration:none;">Register here</a>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
</body>
</html>
