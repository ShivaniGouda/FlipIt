<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo "Welcome, " . $row['name'] . "! You are logged in as " . $row['role'] . ".";
        // redirect to dashboard if you want
        // header("Location: dashboard.html");
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_role'] = $row['role'];
        $_SESSION['user_email'] = $row['email'];
    
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: index.html?error=invalid_password");
        exit();
        
    }
} else {
        // Email not found
    header("Location: index.php?error=user_not_found");
    exit();
    
}

$conn->close();
?>
