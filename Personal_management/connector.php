<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create a new connection to the database using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    // If connection fails, stop script and display error
    die("Connection failed: " . $conn->connect_error);
    
}
// If connected successfully, output a confirmation message
echo "Connected successfully";
?>