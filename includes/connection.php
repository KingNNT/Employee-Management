<?php
require_once("./config/database.php");
$conn = mysqli_connect(Database::$host, Database::$username, Database::$password, Database::$dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
