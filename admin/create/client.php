<?php
include '../includes/db.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$name = test_input($_POST["name"]);
$mob = test_input($_POST["mob"]);
$address = test_input($_POST["address"]);
$sql = "INSERT INTO client (name,mob,address)
VALUES ('$name','$mob','$address')";
if ($conn->query($sql) === TRUE) {
    header("Location: /admin/client.php?page=1&msg=User added Successfully !");
    die();
} else {
    header("Location: /admin/client.php?page=1&err=Something went Wrong!");
    die();
}
?>