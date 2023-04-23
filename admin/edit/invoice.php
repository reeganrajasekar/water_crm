<?php
include '../includes/db.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$paid = test_input($_POST["paid"]);
$id = test_input($_POST["id"]);
$sql = "UPDATE bill SET paid='$paid' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: /admin/invoice.php?page=1&msg=Invoice Edited Successfully !");
    die();
} else {
    header("Location: /admin/invoice.php?page=1&err=Something went Wrong!");
    die();
}
?>