<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Fetch all pickup requests
$sql = "SELECT pr.request_id, pr.request_date, pr.pickup_date, pr.status,
       ew.item_type, ew.item_condition AS `condition`,
       u.name, u.address, u.contact


        FROM pickup_request pr
        JOIN e_waste_item ew ON pr.item_id = ew.item_id
        JOIN users u ON ew.user_id = u.id";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Manage Pickup Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Pickup Requests</h2>
    <form method="POST" action="update_pickup_requests.php">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Item Type</th>
                    <th>Condition</th>
                    <th>User Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Request Date</th>
                    <th>Pickup Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><input type="checkbox" name="selected_requests[]" value="<?= $row['request_id'] ?>"></td>
                        <td><?= $row['item_type'] ?></td>
                        <td><?= $row['condition'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['contact'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['request_date'] ?></td>
                        <td>
                            <input type="date" name="pickup_date[<?= $row['request_id'] ?>]" value="<?= $row['pickup_date'] ?>">
                        </td>
                        <td>
                            <select name="status[<?= $row['request_id'] ?>]" class="form-select">
                                <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Scheduled" <?= $row['status'] == 'Scheduled' ? 'selected' : '' ?>>Scheduled</option>
                                <option value="Completed" <?= $row['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                            </select>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update Selected Requests</button>
    </form>
</body>
</html>
