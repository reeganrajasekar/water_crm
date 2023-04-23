<?php
include '../includes/db.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$address = test_input($_POST["address"]);
$id = test_input($_POST["id"]);
$name = test_input($_POST["name"]);
$mob = test_input($_POST["mob"]);
$sql = "UPDATE client SET name='$name',mob='$mob',address='$address' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: /admin/client.php?page=1&msg=User Details Edited Successfully !");
    die();
} else {
    header("Location: /admin/client.php?page=1&err=Something went Wrong!");
    die();
}
?>