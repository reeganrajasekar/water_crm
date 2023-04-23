<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "trysomething";
$db_name = "form";
if ($_SESSION["lock"] != "nkcw73to92y87v5i&^TY*&V4COR7ITKKU6F764CI6p6I^V*I%^U&^%KI*V") {
  header("Location: /admin");
  die();
}
$conn = new mysqli($servername, $username, $password, $db_name);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>