<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hmis";

// Enable MySQLi error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $dbname);

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");
?>