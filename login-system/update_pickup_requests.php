<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_requests'])) {
    $selected_requests = $_POST['selected_requests'];
    $pickup_dates = $_POST['pickup_date'];
    $statuses = $_POST['status'];

    foreach ($selected_requests as $request_id) {
        $pickup_date = $pickup_dates[$request_id];
        $status = $statuses[$request_id];

        // Update the pickup_request table
        $sql = "UPDATE pickup_request SET pickup_date = '$pickup_date', status = '$status' WHERE request_id = $request_id";
        $conn->query($sql);

        // ✅ Add to donation_record if marked Completed
        if ($status == 'Completed') {
            // Get item_id
            $itemResult = $conn->query("SELECT item_id FROM pickup_request WHERE request_id = $request_id");
            if ($itemRow = $itemResult->fetch_assoc()) {
                $item_id = $itemRow['item_id'];

                // Check if donation already exists
                $check = $conn->query("SELECT * FROM donation_record WHERE item_id = $item_id");
                if ($check->num_rows == 0) {
                    // Get user name
                    $userResult = $conn->query("SELECT u.name FROM users u 
                        JOIN e_waste_item ei ON ei.user_id = u.id 
                        WHERE ei.item_id = $item_id");
                    $userRow = $userResult->fetch_assoc();
                    $user_name = $userRow['name'];

                    $donation_date = date('Y-m-d');

                    // Insert donation record
                    $conn->query("INSERT INTO donation_record (item_id, user_name, donation_date) 
                                  VALUES ($item_id, '$user_name', '$donation_date')");
                }
            }
        }
    }

    header("Location: admin_pickup_requests.php?msg=updated");
    exit();
} else {
    echo "No requests selected.";
}
?>





<!-- <!?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_requests'])) {
    $selected_requests = $_POST['selected_requests'];
    $pickup_dates = $_POST['pickup_date'];
    $statuses = $_POST['status'];

    foreach ($selected_requests as $request_id) {
        $pickup_date = $pickup_dates[$request_id];
        $status = $statuses[$request_id];

        $sql = "UPDATE pickup_request SET pickup_date = '$pickup_date', status = '$status' WHERE request_id = $request_id";
        $conn->query($sql);
    }

    header("Location: admin_pickup_requests.php?msg=updated");
    exit();
} else {
    echo "No requests selected.";
}
?> -->
