<?php
session_start();

require_once __DIR__ . "/database.php"; // Include your database connection code here

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Perform the database query to delete the category
    $deleteQuery = "DELETE FROM categories WHERE id = ?";
    $stmt = $con->prepare($deleteQuery); // Use $con for the database connection

    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("i", $categoryId);

    if ($stmt->execute()) {
        header("Location: categories.php"); // Redirect back to the categories page or appropriate page
        exit();
    } else {
        die("Failed to delete category: " . $stmt->error);
    }
}
?>
