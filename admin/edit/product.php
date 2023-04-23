<?php
include '../includes/db.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$code = test_input($_POST["code"]);
$id = test_input($_POST["id"]);
$name = test_input($_POST["name"]);
$rate = test_input($_POST["rate"]);
$stock = test_input($_POST["stock"]);
$sql = "UPDATE product SET code='$code',name='$name',rate=$rate,stock=$stock WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: /admin/product.php?page=1&msg=Product Edited Successfully !");
    die();
} else {
    header("Location: /admin/product.php?page=1&err=Something went Wrong!");
    die();
}
?>