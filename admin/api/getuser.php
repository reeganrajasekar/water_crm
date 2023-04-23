<?php
include '../includes/db.php';

$mob = $_GET["mob"];

$sql = "SELECT * FROM client where mob='$mob'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
        $data["name"] = htmlspecialchars_decode($row["name"]);
        $data["id"] = $row["id"];
        $data["mob"] = htmlspecialchars_decode($row["mob"]);
        $data["address"] = htmlspecialchars_decode($row["address"]);
    }
    echo json_encode($data);
} else {
    echo json_encode("0");
}

?>