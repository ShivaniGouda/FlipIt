<?php
session_start();
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] != 'admin') {
    // Not logged in or not admin
    header("Location: index.html");
    exit();
}
?>





<!DOCTYPE html>
<html>
<head>
  <title>Register Collection Centre</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="text-center mb-4">Register Collection Centre</h2>
  <form action="register_centre_process.php" method="POST" class="card p-4 shadow">

    <div class="mb-3">
      <label>Centre Name</label>
      <input type="text" name="centre_name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Centre Location</label>
      <input type="text" name="centre_location" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Contact Info</label>
      <input type="text" name="contact_info" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-warning w-100">Submit</button>
  </form>

  <div class="text-center mt-3">
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
  </div>
</div>
</body>
</html>
