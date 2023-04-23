<?php
include '../includes/db.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$userid = test_input($_POST["userid"]);
$username = test_input($_POST["username"]);
$usermob = test_input($_POST["usermob"]);
$useraddress = test_input($_POST["useraddress"]);
$total = test_input($_POST["totalamount"]);
$payment = test_input($_POST["paymentmethod"]);
$paid = test_input($_POST["paidamount"]);
$totalitems = test_input($_POST["overitems"]);
$data = [];
for ($i = 0; $i < $totalitems; $i++) {
    if ($_POST["itemid" . $i]) {
        $id = $_POST["itemid" . $i];
        $data[$i] = [$_POST["itemid" . $i], $_POST["totalitem" . $i], $_POST["rate" . $i], $_POST["amount" . $i]];
        $sql = "SELECT stock FROM product where id='$id'";
        $result = $conn->query($sql);
        $stock = 0;
        while ($row = $result->fetch_assoc()) {
            $stock = $row["stock"] - $_POST["totalitem" . $i];
        }
        $sql = "UPDATE product SET stock='$stock' WHERE id=$id";
        $conn->query($sql);
    }
}
$final = json_encode($data);
$sql = "INSERT INTO bill (userid,username,usermob,useraddress,total,payment,paid,items)
VALUES ('$userid','$username','$usermob','$useraddress',$total,'$payment','$paid','$final')";
if ($conn->query($sql) === TRUE) {
    header("Location: /admin/invoice.php?page=1&msg=Bill added Successfully !");
    die();
} else {
    header("Location: /admin/invoice.php?page=1&err=Something went Wrong!");
    die();
}
?>