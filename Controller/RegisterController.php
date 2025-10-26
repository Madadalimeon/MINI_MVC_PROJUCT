<?php
include_once ("../Model/RegisterUser.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "Received data: Username = $username, Email = $email";
    
    $user = new RegisterUser($username, $email, $password);

    if ($user->register()) {
        header("Location: login.php");
        exit();
    } else {
        header("Location: register_view.php?error=1");
        exit();
    }
}
?>
