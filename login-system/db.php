<?php
$servername = "localhost";
$username = "root"; // change if your MySQL username is different
$password = "shivani31";     // enter your MySQL password
$dbname = "login_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
