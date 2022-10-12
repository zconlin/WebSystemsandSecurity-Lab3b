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

$stmt = $conn->prepare("INSERT INTO `task`(`user_id`, `text`, `date`, `done`) VALUES (?,?,?,'0')");
$stmt->bind_param("iss",$_SESSION["id"],$_POST["text"],$_POST["date"]);
$stmt->execute();
$stmt->close();

header("Location: ../index.php");
die();
?>