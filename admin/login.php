<?php
session_start();
if ($_POST["email"] == "admin@gmail.com") {
    if ($_POST["password"] == "admin") {
        $_SESSION["lock"] = "nkcw73to92y87v5i&^TY*&V4COR7ITKKU6F764CI6p6I^V*I%^U&^%KI*V";
        header("Location: /admin/dashboard.php");
        die();
    } else {
        header("Location: /admin/?err=username or password is incorrect!");
        die();
    }
} else {
    header("Location: /admin/?err=username or password is incorrect!");
    die();
}


?>