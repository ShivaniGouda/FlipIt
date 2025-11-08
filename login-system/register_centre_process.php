<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Get form inputs
$name = $_POST['centre_name'];
$location = $_POST['centre_location'];
$contact = $_POST['contact_info'];

// Insert into database
$sql = "INSERT INTO collection_centre (centre_name, centre_location, contact_info) 
        VALUES ('$name', '$location', '$contact')";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php?success=centre_registered");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
