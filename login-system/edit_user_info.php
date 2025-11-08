<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: index.html");
    exit();
}

$email = $_SESSION['user_email'];

// Fetch existing user data
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($query);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Your Info</h2>

    <form action="edit_user_info_process.php" method="POST" class="card p-4 shadow">
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Contact No.</label>
            <input type="text" class="form-control" name="contact" value="<?= $user['contact'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea class="form-control" name="address" rows="3" required><?= $user['address'] ?? '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update Info</button>
    </form>

    <div class="text-center mt-3">
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>
</body>
</html>
