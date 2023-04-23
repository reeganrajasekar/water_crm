<?php
include '../includes/db.php';

$id = $_GET["id"];

$sql = "SELECT * FROM product where id='$id'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
        $data["code"] = $row["code"];
        $data["name"] = $row["name"];
        $data["stock"] = $row["stock"];
        $data["rate"] = $row["rate"];
    }
    echo json_encode($data);
} else {
    echo json_encode("0");
}

?>