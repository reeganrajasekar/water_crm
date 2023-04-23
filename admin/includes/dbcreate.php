<?php
require("./db.php");
// client
$sql = "CREATE TABLE client (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(500) NOT NULL,
    mob VARCHAR(500) NOT NULL,
    address VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Client created successfully<br>";
}
$sql = "INSERT INTO client (name,mob,address)
VALUES ('Non-User','0000','0000')";

if ($conn->query($sql) === TRUE) {
}
// Bill
$sql = "CREATE TABLE bill (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userid INT(6) UNSIGNED,
    username VARCHAR(500) NOT NULL,
    usermob VARCHAR(500) NOT NULL,
    useraddress VARCHAR(500) NOT NULL,
    items JSON NOT NULL,
    total INT(255) NOT NULL,
    payment VARCHAR(50) NOT NULL,
    paid INT(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userid) REFERENCES client(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Bill created successfully<br>";
}
// product
$sql = "CREATE TABLE product (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL,
    name VARCHAR(500) NOT NULL,
    rate INT(50) NOT NULL,
    stock INT(50) NOT NULL,
    quantity VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Product created successfully<br>";
}

$conn->close();
?>