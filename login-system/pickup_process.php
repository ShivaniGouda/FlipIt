<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] != 'user') {
    header("Location: index.html");
    exit();
}

if (isset($_POST['item_ids']) && isset($_POST['request_date'])) {
    $item_ids = $_POST['item_ids'];
    $request_date = $_POST['request_date'];

    foreach ($item_ids as $item_id) {
        $sql = "INSERT INTO pickup_request (item_id, request_date, status)
                VALUES ('$item_id', '$request_date', 'Pending')";
        $conn->query($sql);
    }

    header("Location: dashboard.php?msg=pickup_requested");
    exit();
} else {
    echo "Please select at least one item and a request date.";
}
?>
