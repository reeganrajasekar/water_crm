<?php
include '../includes/db.php';
$id = $_GET["id"];
$sql = "DELETE FROM product where id='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location: /admin/product.php?page=1&msg=Product Deleted Successfully !");
    die();
} else {
    header("Location: /admin/product.php?page=1&err=Something went Wrong!");
    die();
}
?>