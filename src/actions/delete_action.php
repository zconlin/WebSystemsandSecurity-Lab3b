<?php
session_start();
$mysql_servername = getenv("MYSQL_SERVERNAME");
$mysql_user = getenv("MYSQL_USER");
$mysql_password = getenv("MYSQL_PASSWORD");
$mysql_database = getenv("MYSQL_DATABASE");

// Create connection
$conn = new mysqli($mysql_servername, $mysql_user, $mysql_password, $mysql_database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("DELETE FROM `task` WHERE id = ?");
$stmt->bind_param("i", $_POST["taskID"]);
$stmt->execute();
$stmt->close();


header("Location: ../index.php");
die();
?>