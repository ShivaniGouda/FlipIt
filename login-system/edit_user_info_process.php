<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: index.html");
    exit();
}

$email = $_SESSION['user_email'];

// Get form data
$name = $_POST['name'];
$contact = $_POST['contact'];
$address = $_POST['address'];

// Update query
$update_sql = "UPDATE users SET name = '$name', contact = '$contact', address = '$address' WHERE email = '$email'";

if ($conn->query($update_sql) === TRUE) {
    // Success
    $_SESSION['user_name'] = $name; // update session name if changed
    header("Location: dashboard.php?success=info_updated");
    exit();
} else {
    echo "Error updating info: " . $conn->error;
}

$conn->close();
?>
