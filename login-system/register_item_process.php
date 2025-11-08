<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: index.html");
    exit();
}

// Get form data
$item_type = $_POST['item_type'];
$brand = $_POST['brand'];
$item_condition = $_POST['item_condition'];

// Get user ID (You must modify db.php if needed to fetch id properly, or get it from session)
$user_email = $_SESSION['user_email'];
$user_query = "SELECT id FROM users WHERE email = '$user_email'";
$user_result = $conn->query($user_query);

if ($user_result->num_rows == 1) {
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['id'];

    // Insert into e_waste_item table
    $insert_sql = "INSERT INTO e_waste_item (user_id, item_type, brand, item_condition)
                   VALUES ('$user_id', '$item_type', '$brand', '$item_condition')";

    if ($conn->query($insert_sql) === TRUE) {
        // Redirect with success message
        header("Location: dashboard.php?success=item_registered");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "User not found.";
}

$conn->close();
?>
