<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: index.html");
    exit();
}

$user_email = $_SESSION['user_email'];

// Get user_id
$user_query = $conn->prepare("SELECT id FROM users WHERE email = ?");
$user_query->bind_param("s", $user_email);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();
$user_id = $user['id'];

// Fetch pickup requests for this user
$sql = "SELECT pr.request_id, ew.item_type, ew.item_condition, pr.request_date, pr.pickup_date, pr.status
        FROM pickup_request pr
        JOIN e_waste_item ew ON pr.item_id = ew.item_id
        WHERE ew.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pickup Status</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Your Pickup Requests Status</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Item Type</th>
          <th>Condition</th>
          <th>Request Date</th>
          <th>Pickup Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['item_type']) ?></td>
            <td><?= htmlspecialchars($row['item_condition']) ?></td>
            <td><?= htmlspecialchars($row['request_date']) ?></td>
            <td><?= htmlspecialchars($row['pickup_date'] ?? 'Not Scheduled') ?></td>
            <td>
              <?php
                $status = ucfirst($row['status']);
                if ($status == 'Pending') echo "<span class='badge bg-warning text-dark'>$status</span>";
                elseif ($status == 'Scheduled') echo "<span class='badge bg-info text-dark'>$status</span>";
                else echo "<span class='badge bg-success'>$status</span>";
              ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>

<?php
$conn->close();
?>
