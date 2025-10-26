<?php
session_start();
session_unset();
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
header("Location: ../View/login.php");
exit();
?>