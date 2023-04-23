<?php
include '../includes/db.php';
$id = $_GET["id"];
$sql = "DELETE FROM bill where id='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location: /admin/invoice.php?page=1&msg=Invoice Deleted Successfully !");
    die();
} else {
    header("Location: /admin/invoice.php?page=1&err=Something went Wrong!");
    die();
}
?>