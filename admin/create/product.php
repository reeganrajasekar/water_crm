<?php
include '../includes/db.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$code = test_input($_POST["code"]);
$name = test_input($_POST["name"]);
$rate = test_input($_POST["rate"]);
$stock = test_input($_POST["stock"]);
$quantity = test_input($_POST["quantity"]);
$sql = "INSERT INTO product (code,name,rate,stock,quantity)
VALUES ('$code','$name','$rate','$stock','$quantity')";
if ($conn->query($sql) === TRUE) {
    header("Location: /admin/product.php?page=1&msg=Product added Successfully !");
    die();
} else {
    header("Location: /admin/product.php?page=1&err=Something went Wrong!");
    die();
}
?>