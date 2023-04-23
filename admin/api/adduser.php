<?php
include '../includes/db.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$name = test_input($_GET["name"]);
$mob = test_input($_GET["mob"]);
$address = test_input($_GET["address"]);

$sql = "INSERT INTO client (name,mob,address)
VALUES ('$name','$mob','$address')";

if ($conn->query($sql) === TRUE) {
    echo json_encode("0");
} else {
    echo json_encode("ok");
}


?>