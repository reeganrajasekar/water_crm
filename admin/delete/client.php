<?php
include '../includes/db.php';
$id = $_GET["id"];
$sql = "DELETE FROM client where id='$id'";
try {
    if ($conn->query($sql) === TRUE) {
        header("Location: /admin/client.php?page=1&msg=User Details Deleted Successfully !");
        die();
    } else {
        header("Location: /admin/client.php?page=1&err=Something went Wrong!");
        die();
    }
} catch (Exception $e) {
    header("Location: /admin/client.php?page=1&err=Something went Wrong!");
    die();
}
?>