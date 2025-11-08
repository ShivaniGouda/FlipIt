<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - E-Waste System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
        background: #f4f6f9;
        font-family: 'Segoe UI', sans-serif;
    }
    .dashboard-container {
        padding: 30px;
    }
    .dashboard-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
        border: none;
    }
    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .card i {
        font-size: 2rem;
        color: #0d6efd;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <i class="fas fa-recycle me-2"></i> E-Waste Management
    </a>

    <div class="d-flex">
      <span class="navbar-text text-white me-3">
        Welcome, <?php echo $_SESSION['user_name']; ?>!
      </span>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h1 class="text-center mb-4">E-Waste Collection and Recycling Management System</h1><br>

  <div class="row g-4">
    <!-- Common for Both User and Admin -->
    <div class="col-md-4">
      <a href="edit_user_info.php" class="text-decoration-none">
        <div class="card p-4 text-center bg-white">
          <i class="fas fa-user-edit mb-3"></i>
          <h5 class="card-title">Edit User Info</h5>
        </div>
      </a>
    </div>

    <!-- User-Specific Section -->
    <?php if ($_SESSION['user_role'] == 'user'): ?>
      <div class="col-md-4">
        <a href="register_item.php" class="text-decoration-none">
          <div class="card p-4 text-center bg-white">
            <i class="fas fa-leaf mb-3"></i>
            <h5 class="card-title">Register E-Waste Item</h5>
          </div>
        </a>
      </div>

      <div class="col-md-4">
        <a href="pickup_request.php" class="text-decoration-none">
          <div class="card p-4 text-center bg-white">
            <i class="fas fa-truck mb-3"></i>
            <h5 class="card-title">Request Pickup</h5>
          </div>
        </a>
      </div>

      <div class="col-md-4">
        <a href="check_status.php" class="text-decoration-none">
          <div class="card p-4 text-center bg-white">
            <i class="fas fa-info-circle mb-3"></i>
            <h5 class="card-title">Check Pickup Status</h5>
          </div>
        </a>
      </div>

      <!-- Top Donators Section -->
      <h3 class="text-center my-4 text-success">🌟 Top Donators 🌟</h3>
      <div class="row justify-content-center">
        <?php
        include 'db.php';
        $top_query = "SELECT user_name, COUNT(*) as donations FROM donation_record GROUP BY user_name ORDER BY donations DESC LIMIT 5";
        $top_result = $conn->query($top_query);

        while ($donator = $top_result->fetch_assoc()):
        ?>
          <div class="col-md-3 m-2">
            <div class="card border-success shadow">
              <div class="card-body text-center">
                <h5 class="card-title text-primary"><?= htmlspecialchars($donator['user_name']) ?></h5>
                <p class="card-text">🗑️ Donated <strong><?= $donator['donations'] ?></strong> item(s)</p>
                <p class="text-muted">Thank you for making a difference! 🌍</p>
                <!-- <p>Donated <strong><!?= $donator['donations'] ?></strong> item(s)</p> -->
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

    <!-- Admin-Specific Section -->
    <?php if ($_SESSION['user_role'] == 'admin'): ?>
      <div class="col-md-4">
        <a href="register_centre.php" class="text-decoration-none">
          <div class="card p-4 text-center bg-white">
            <i class="fas fa-building-user mb-3"></i>
            <h5 class="card-title">Register Collection Centre</h5>
          </div>
        </a>
      </div>

      <div class="col-md-4">
        <a href="admin_pickup_requests.php" class="text-decoration-none">
          <div class="card p-4 text-center bg-white">
            <i class="fas fa-tasks mb-3"></i>
            <h5 class="card-title">Manage Pickup Requests</h5>
          </div>
        </a>
      </div>
    <?php endif; ?>

  </div>
</div>

</body>
</html>
