<!-- register_item.php -->
<?php
session_start();
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] == 'admin') {
    // Not logged in or trying to access as admin
    header("Location: dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register E-Waste Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Register E-Waste Item</h2>

  <form action="register_item_process.php" method="POST" class="card p-4 shadow">
    <div class="mb-3">
      <label>Item Type</label>
      <input type="text" class="form-control" name="item_type" placeholder="e.g. Mobile Phone, Laptop" required>
    </div>

    <div class="mb-3">
      <label>Item Brand</label>
      <input type="text" class="form-control" name="brand" placeholder="e.g. HP, Dell" required>
    </div>

    <div class="mb-3">
      <label>Condition</label>
      <select class="form-control" name="item_condition" required>
        <option value="">Select Condition</option>
        <option value="Working">Working</option>
        <option value="Non-Working">Non-Working</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success w-100">Register Item</button>
  </form>

  <div class="text-center mt-3">
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
  </div>
</div>

</body>
</html>
