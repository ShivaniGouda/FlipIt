<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] != 'user') {
    header("Location: index.html");
    exit();
}

// Get user ID
$user_email = $_SESSION['user_email'];
$sql = "SELECT id FROM users WHERE email = '$user_email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$user_id = $user['id'];

// Get user's registered items
$items = [];
$sql = "SELECT * FROM e_waste_item WHERE user_id = $user_id";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) {
    $items[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pickup Request</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Schedule Pickup Request</h2>
  <form action="pickup_process.php" method="POST">
    <div class="mb-3">
      <label>Select E-Waste Items:</label><br>
      <?php foreach ($items as $item): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="item_ids[]" value="<?= $item['item_id'] ?>">
          <label class="form-check-label">
            <?= $item['item_type'] ?> (<?= $item['brand'] ?><?= isset($item['condition']) ? ', ' . $item['condition'] : '' ?>)

           
          </label>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="mb-3">
      <label>Pickup Request Date:</label>
      <input type="date" name="request_date" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Submit Pickup Request</button>
  </form>
</body>
</html>
