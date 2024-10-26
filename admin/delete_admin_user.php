<?php
session_start();

require_once __DIR__ . "/connection.php"; // Include your database connection code here

if (isset($_GET['id'])) {
    $adminUserId = $_GET['id'];

    // Perform the database query to delete the admin user
    $deleteQuery = "DELETE FROM admin WHERE id = ?";
    $stmt = $con->prepare($deleteQuery);

    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("i", $adminUserId);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        die("Failed to delete admin user: " . $stmt->error);
    }
}
?>
