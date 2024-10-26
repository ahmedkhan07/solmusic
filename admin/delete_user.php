<?php
session_start();

require_once __DIR__ . "/connection.php"; // Include your database connection code here

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Perform the database query to delete the user
    $deleteQuery = "DELETE FROM login WHERE id = ?";
    $stmt = $con->prepare($deleteQuery); // Change $mysqli to $con

    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        die("Failed to delete user: " . $stmt->error);
    }
}
?>
